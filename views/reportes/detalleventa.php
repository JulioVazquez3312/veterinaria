<?php

$content = "
            <style>
            h1{
                font-weight: 300;
                color: #00205b;
                text-transform: uppercase;
                margin-bottom: 48px;
                font-size: 32px;
                margin-top: 0;
                text-align: center;
            }
            table {
                margin: top 20%;
                width: 100%; /* Ocupa el ancho completo de la página */
                border-collapse: collapse; /* Elimina el espacio entre bordes */
                font-family: Arial, sans-serif; /* Estilo de fuente más moderno */
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
            <h1>Listado de Productos</h1>            
            <div>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Producto</th>
                    <th>Precio</th>
                </tr>
                </thead>
                <tbody>";
                foreach ($datos as $dato) {
                    $content .= "
                    <tr>
                        <th scope=" . "row" . ">" . $dato['id_producto'] . "</th>
                        <td>" . $dato['marca'] . "</td>
                        <td>" . $dato['producto'] . "</td>
                        <td>$ " . $dato['precio'] . "</td>
                    </tr>";
                }
                $content .= "
                </tbody>            
            </table>
            <p> Se encontraron " . count($datos) . " productos</p>
            </div>";
