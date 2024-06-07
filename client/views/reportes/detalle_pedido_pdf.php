<?php
$content = "
<style>
    h1 {
        font-weight: 300;
        color: #00205b;
        text-transform: uppercase;
        margin-bottom: 48px;
        font-size: 32px;
        margin-top: 0;
        text-align: center;
    }
    table {
        margin-top: 20%;
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        font-size: 15px;
    }
    tr, th, td {
        padding: 10px;
        text-align: left;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    td {
        color: #00205b;
        font-weight: 300;
    }
</style>
<h1>Detalle del Pedido</h1>
<div>
<table>
    <thead>
        <tr>
            <th>ID Producto</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Total Precio</th>
        </tr>
    </thead>
    <tbody>";
foreach ($datos as $dato) {
    $content .= "
    <tr>
        <td>" . htmlspecialchars($dato['id_venta']) . "</td>
        <td>" . htmlspecialchars($dato['producto']) . "</td>
        <td>" . htmlspecialchars($dato['cantidad_producto']) . "</td>
        <td>$ " . htmlspecialchars($dato['total_precio']) . "</td>
    </tr>";
}
$content .= "
    </tbody>
</table>
<p>Se encontraron " . count($datos) . " productos en este pedido.</p>
</div>";
?>
