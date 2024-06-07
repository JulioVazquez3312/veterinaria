<?php
require '../vendor/autoload.php' ;
require (__DIR__ . '\orders.class.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$app = new Order();
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_venta = (isset($_GET['id_venta'])) ? $_GET['id_venta'] : null;
$datos = array();
$alerta= array();
$exel = new Spreadsheet();
$hojaActiva = $exel->getActiveSheet();
$hojaActiva->setTitle("Orders");
$datos = $app->getAll();

switch ($action) {
    case 'create':
        $hojaActiva->setCellValue('A1','id_usuario');
        $hojaActiva->setCellValue('B1','id_venta');
        $hojaActiva->setCellValue('C1','fecha');
        $hojaActiva->setCellValue('D1','cantidad_producto');
        $hojaActiva->setCellValue('E1','total_precio');
        
        $fila = 2;
        
        foreach($datos as $dato){
            $hojaActiva->setCellValue('A'.$fila,$dato['id_usuario']);
            $hojaActiva->setCellValue('B'.$fila,$dato['id_venta']);
            $hojaActiva->setCellValue('C'.$fila,$dato['fecha']);
            $hojaActiva->setCellValue('D'.$fila,$dato['cantidad_producto']);
            $hojaActiva->setCellValue('E'.$fila,$dato['total_precio']);
            $fila++;
        }
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Orders.xls"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($exel, 'Xls');
        $writer->save('php://output');
        exit;
        break;
}

?>