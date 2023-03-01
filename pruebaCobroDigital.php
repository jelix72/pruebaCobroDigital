<?php

// Procesamiento archivo rend-rev* PagoDirecto
$arregloDetalles = array();
$nombreArchivo = "REND.REV-REVC8496.REV-20191125.txt";
if (!$file = fopen($nombreArchivo, "r")) {
    echo "No se ha podido abrir el archivo " . $nombreArchivo;
} else {
    $nroRegistros = 0;
    $subtotalMonto = 0;
    $medioDePago = "PagoDirecto";
    echo "Nombre del Archivo a procesar: " . $nombreArchivo . "<br>";
    echo "Nombre del Medio de Pago: " . $medioDePago . "<br><br>";
    echo "<table id='tabla_instrumentos' class='table table-hover' style='width:50%; text-align: center; font-size: 12pt;' border='1'>";
    echo "<thead><tr><th class='text-center' style='width: 10%'>NRO TRANSACCIÓN</th>";
    echo "<th class='text-center' style='width: 10%'>MONTO</th>";
    echo "<th class='text-center' style='width: 10%'>IDENTIFICADOR</th>";
    echo "<th class='text-center' style='width: 10%'>FECHA DE PAGO</th>";
    echo "<th class='text-center' style='width: 20%'>MEDIO DE PAGO</th></tr></thead>";
    echo "<tbody id='resultados'>";
    while ($linea = fgets($file)) {
        if (substr($linea, 0, 4) == "0000") {
            // Procesar Cabecera 0000
            $tipoRegistro = substr($linea, 0, 4);
            $nroDePrestacion = substr($linea, 4, 4);
            $servicio = substr($linea, 8, 1);
            $fechaDeGeneracion = substr($linea, 9, 8);
            $medioDePago = pagoDirectoMedioDePago(substr($linea, 8, 1));
        } elseif (substr($linea, 0, 4) != "0000" and substr($linea, 0, 4) != "9999") {
            // Procesar registros de Datos
            if (substr($linea, 0, 4) == "0371") {
                echo "<tr style='font-size: 11pt;'>";
                $nroTransaccion = substr($linea, 52, 15);
                $montoParteEntera = substr($linea, 75, 12);
                $montoParteDecimal = substr($linea, 87, 2);
                $monto = floatval($montoParteEntera . "." . $montoParteDecimal);
                $identificador = substr($linea, 58, 19);
                $fechaDePago = substr($linea, 73, 2) . "/" . substr($linea, 71, 2) . "/" . substr($linea, 67, 4);
                $subtotalMonto = $subtotalMonto + $monto;
                echo "<td style='vertical-align: middle; text-align: center;'>" . $nroTransaccion . "</td>";
                echo "<td style='vertical-align: middle; text-align: right;'>" . number_format($monto, 2, ",", ".") . "</td>";
                echo "<td style='vertical-align: middle; text-align: center;'>" . $identificador . "</td>";
                echo "<td style='vertical-align: middle; text-align: center;'>" . $fechaDePago . "</td>";
                echo "<td style='vertical-align: middle; text-align: center;'>" . $medioDePago . "</td>";
                $nroRegistros++;
                echo "</tr>";
            }
        } elseif (substr($linea, 0, 4) == "9999") {
            // Procesar Pie 9999
            $tipoDeRegistro = substr($linea, 0, 4);
            $cantidadDeRegistros = substr($linea, 39, 7);
            $importeParteEntera = substr($linea, 25, 12);
            $importeParteDecimal = substr($linea, 37, 2);
            $importe = floatval($importeParteEntera . "." . $importeParteDecimal);
        }
    }
    echo "</tbody></table>";
    echo '<pre>';
    echo "Cantidad de registros de datos contabilizados: " . $nroRegistros . "<br>";
    echo "Total Monto Archivo calculado: $ " . $subtotalMonto . "<br>";
    echo "Cantidad de registros de datos informados en archivo: " . intval($cantidadDeRegistros) . "<br>";
    echo "Total Importe del Archivo informado: $ " . $importe . "<br>";
    echo '</pre><br><hr><br>';
}
fclose($file);
// Fin procesamiento archivo rend-rev* PagoDirecto

// Procesamiento archivo rend-cob* PagoDirecto
$nombreArchivo = "REND.COB-COBC8496.COB-20191125.TXT.2019";
if (!$file = fopen($nombreArchivo, "r")) {
    echo "No se ha podido abrir el archivo " . $nombreArchivo;
} else {
    $nroRegistros = 0;
    $subtotalMonto = 0;
    $medioDePago = "PagoDirecto";
    echo "Nombre del Archivo a procesar: " . $nombreArchivo . "<br>";
    echo "Nombre del Medio de Pago: " . $medioDePago . "<br><br>";
    echo "<table id='tabla_instrumentos' class='table table-hover' style='width:50%; text-align: center; font-size: 12pt;' border='1'>";
    echo "<thead><tr><th class='text-center' style='width: 10%'>NRO TRANSACCIÓN</th>";
    echo "<th class='text-center' style='width: 10%'>MONTO</th>";
    echo "<th class='text-center' style='width: 10%'>IDENTIFICADOR</th>";
    echo "<th class='text-center' style='width: 10%'>FECHA DE PAGO</th>";
    echo "<th class='text-center' style='width: 20%'>MEDIO DE PAGO</th></tr></thead>";
    echo "<tbody id='resultados'>";
    while ($linea = fgets($file)) {
        if (substr($linea, 0, 4) == "0000") {
            // Procesar Cabecera 0000
            $tipoRegistro = substr($linea, 0, 4);
            $nroDePrestacion = substr($linea, 4, 4);
            $servicio = substr($linea, 8, 1);
            $fechaDeGeneracion = substr($linea, 9, 8);
            $medioDePago = pagoDirectoMedioDePago(substr($linea, 8, 1));
        } elseif (substr($linea, 0, 4) != "0000" and substr($linea, 0, 4) != "9999") {
            // Procesar registros de Datos
            if (substr($linea, 0, 4) == "0370") {
                echo "<tr style='font-size: 11pt;'>";
                $nroTransaccion = substr($linea, 52, 15);
                $montoParteEntera = substr($linea, 302, 12);
                $montoParteDecimal = substr($linea, 314, 2);
                $monto = floatval($montoParteEntera . "." . $montoParteDecimal);
                $identificador = substr($linea, 58, 19);
                $fechaDePago = substr($linea, 301, 2) . "/" . substr($linea, 299, 2) . "/" . substr($linea, 294, 4);
                $subtotalMonto = $subtotalMonto + $monto;
                echo "<td style='vertical-align: middle; text-align: center;'>" . $nroTransaccion . "</td>";
                echo "<td style='vertical-align: middle; text-align: right;'>" . number_format($monto, 2, ",", ".") . "</td>";
                echo "<td style='vertical-align: middle; text-align: center;'>" . $identificador . "</td>";
                echo "<td style='vertical-align: middle; text-align: center;'>" . $fechaDePago . "</td>";
                echo "<td style='vertical-align: middle; text-align: center;'>" . $medioDePago . "</td>";
                $nroRegistros++;
                echo "</tr>";
            }
        } elseif (substr($linea, 0, 4) == "9999") {
            // Procesar Pie 9999
            $tipoDeRegistro = substr($linea, 0, 4);
            $cantidadDeRegistros = substr($linea, 39, 7);
            $importeParteEntera = substr($linea, 25, 12);
            $importeParteDecimal = substr($linea, 37, 2);
            $importe = floatval($importeParteEntera . "." . $importeParteDecimal);
        }
    }
    echo "</tbody></table>";
    echo '<pre>';
    echo "Cantidad de registros de datos contabilizados: " . $nroRegistros . "<br>";
    echo "Total Monto Archivo calculado: $ " . $subtotalMonto . "<br>";
    echo "Cantidad de registros de datos informados en archivo: " . intval($cantidadDeRegistros) . "<br>";
    echo "Total Importe del Archivo informado: $ " . $importe . "<br>";
    echo '</pre><br><hr><br>';
}
fclose($file);
// Fin procesamiento archivo rend-cob* PagoDirecto

// Procesamiento archivo PlusPagos
$nombreArchivo = "888ENTES5723_308.txt.2021";
if (!$file = fopen($nombreArchivo, "r")) {
    echo "No se ha podido abrir el archivo " . $nombreArchivo;
} else {
    $nroRegistros = 0;
    $subtotalMonto = 0;
    $medioDePago = "PlusPagos";
    echo "Nombre del Archivo a procesar: " . $nombreArchivo . "<br>";
    echo "Nombre del Medio de Pago: " . $medioDePago . "<br><br>";
    echo "<table id='tabla_instrumentos' class='table table-hover' style='width:50%; text-align: center; font-size: 12pt;' border='1'>";
    echo "<thead><tr><th class='text-center' style='width: 10%'>NRO TRANSACCIÓN</th>";
    echo "<th class='text-center' style='width: 10%'>MONTO</th>";
    echo "<th class='text-center' style='width: 10%'>IDENTIFICADOR</th>";
    echo "<th class='text-center' style='width: 10%'>FECHA DE PAGO</th>";
    echo "<th class='text-center' style='width: 20%'>MEDIO DE PAGO</th></tr></thead>";
    echo "<tbody id='resultados'>";
    while ($linea = fgets($file)) {
        echo "<tr style='font-size: 11pt;'>";
        if (substr($linea, 0, 6) == "HEADER") {
            // Procesar Cabecera Header
        } elseif (substr($linea, 0, 5) == "DATOS") {
            // Procesar registros de Datos
            $nroTransaccion = substr($linea, 40, 8);
            $montoParteEntera = substr($linea, 77, 9);
            $montoParteDecimal = substr($linea, 86, 2);
            $monto = floatval($montoParteEntera . "." . $montoParteDecimal);
            $identificador = substr($linea, 58, 19);
            $fechaDePago = substr($linea, 228, 2) . "/" . substr($linea, 226, 2) . "/20" . substr($linea, 224, 2);
            $medioDePago = plusPagoMedioDePago(substr($linea, 247, 2));
            echo "<td style='vertical-align: middle; text-align: center;'>" . $nroTransaccion . "</td>";
            echo "<td style='vertical-align: middle; text-align: right;'>" . number_format($monto, 2, ",", ".") . "</td>";
            echo "<td style='vertical-align: middle; text-align: center;'>" . $identificador . "</td>";
            echo "<td style='vertical-align: middle; text-align: center;'>" . $fechaDePago . "</td>";
            echo "<td style='vertical-align: middle; text-align: center;'>" . $medioDePago . "</td>";
            $subtotalMonto = $subtotalMonto + $monto;
            $nroRegistros++;
        } elseif (substr($linea, 0, 7) == "TRAILER") {
            // Procesar Pie Trailer
            $tipoDeRegistro = substr($linea, 0, 7);
            $cantidadDeRegistros = substr($linea, 7, 8);
            $importeParteEntera = substr($linea, 15, 11);
            $importeParteDecimal = substr($linea, 25, 2);
            $importe = floatval($importeParteEntera . "." . $importeParteDecimal);
            $cantidaDeTRX = substr($linea, 28, 8);
        }
        echo "</tr>";
    }
    echo "</tbody></table>";
    echo '<pre>';
    echo "Cantidad de registros de datos contabilizados: " . $nroRegistros . "<br>";
    echo "Total Monto Archivo calculado: $ " . $subtotalMonto . "<br>";
    echo "Cantidad de registros de datos informados en archivo: " . intval($cantidadDeRegistros) . "<br>";
    echo "Total Importe del Archivo informado: $ " . $importe . "<br>";
    echo "Cantidad de Transacciones informadas en archivo: " . intval($cantidaDeTRX) . "<br>";
    echo '</pre>';
}
fclose($file);
// Fin procesamiento archivo PlusPagos

function plusPagoMedioDePago($codigo)
{
    if ($codigo == "00") {
        return "Efectivo";
    } elseif ($codigo == "90") {
        return "Tarjeta de Débito";
    } elseif ($codigo == "99") {
        return "Tarjeta de Crédito";
    }
}

function pagoDirectoMedioDePago($codigo)
{
    if ($codigo == "D") {
        return "Débito Automático";
    } elseif ($codigo == "P") {
        return "Pago Automático";
    } elseif ($codigo == "C") {
        return "Sistema Nac. de Pagos";
    }
}

?>