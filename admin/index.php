<?php
include (__DIR__."/views/header.php");
include (__DIR__."/sistema.class.php");
$app = new Sistema;
$app->checkRol('Administrador', true);
$sql="SELECT m.marca, SUM(vd.cantidad*p.precio) AS monto FROM marca m JOIN producto p ON m.id_marca=p.id_marca 
JOIN venta_detalle vd ON vd.id_producto=p.id_producto GROUP BY m.marca ORDER BY m.marca ASC;";
$datos=$app->query($sql);
?>
<div class="container py-3 mt-4">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Marca');
        data.addColumn('number', 'Monto');

        <?php foreach($datos as $dato): ?>
          data.addRow(["<?php echo $dato["marca"]; ?>", <?php echo $dato['monto']; ?>]);
        <?php endforeach; ?>

        var options = {
          width: 800,
          chart: {
            title: 'Ventas por Marca',
            subtitle: 'Monto de ventas por marca'
          },
          bars: 'horizontal'
        };

        var chart = new google.charts.Bar(document.getElementById('dual_x_div'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

    <div id="dual_x_div" style="width: 900px; height: 500px;"></div>

</div>
<?php include (__DIR__."/views/footer.php"); ?>
