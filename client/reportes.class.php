<?php
include __DIR__.'/sistema.class.php';
require '../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class Reportes extends Sistema {
    function productos(){        
        try {
            $this->connect();
            $stmt = $this->conn->prepare("SELECT p.id_producto, m.marca, p.producto, p.precio 
            FROM producto p join marca m on p.id_marca = m.id_marca
            order by 2,3;");            
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos=array();
            $datos=$stmt->fetchAll();
            $content = ob_get_clean();
            include __DIR__.'/views/reportes/productos.php';
            ob_start();
            
            $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3);
            $html2pdf->writeHTML($content);
            $html2pdf->output('producto.pdf');
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
        
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }

    function orders($id_venta) {
        try {
            $this->connect();
            $stmt = $this->conn->prepare("
                SELECT id_venta, producto, cantidad_producto, total_precio 
                FROM order_detail 
                WHERE id_venta = :id_venta
                ORDER BY producto;
            ");
            $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $content = ob_get_clean();
            include __DIR__.'/views/reportes/detalle_pedido_pdf.php';
            ob_start();

            $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', 3);
            $html2pdf->writeHTML($content);
            $html2pdf->output('detalle_pedido.pdf');
        } catch (Html2PdfException $e) {
            if (isset($html2pdf)) {
                $html2pdf->clean();
            }
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }
}

?>