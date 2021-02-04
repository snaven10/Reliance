<?php
@session_start();
include '../clases/clase_cierre.php';
$cierre = new cierre();

include '../clases/clase_encabezado_factura.php';
$encabezado_factura = new encabezado_factura();
include '../clases/clase_abonos.php';
$abonos = new abonos();

$fecha_inicial = $_POST['fecha_inicial'];
$fecha_inicial = new DateTime($fecha_inicial);
$fecha_inicial = $fecha_inicial->format('Y-m-d');
$fecha_final = $_POST['fecha_final'];
$fecha_final = new DateTime($fecha_final);
$fecha_final = $fecha_final->format('Y-m-d');
if ($_POST['tipo'] == 0) { 
    $depositos = $cierre->get_depositos_fecha($fecha_inicial.' 05:00:00',$fecha_final.' 23:59:59');  ?>
    <table class='table table-striped table-bordered' id=''>
        <CENTER><h2>REPORTE DE DEPOSITOS</h2></CENTER>
        <thead>
            <tr>
                <th>Fecha Hora</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($depositos)>0) {
                $Monto = 0;
               foreach ($depositos as $row) { ?>
                    <tr> 
                        <td><?php echo $row['Fecha'] ?></td>
                        <td><?php $Monto += $row['Monto']; echo "$".number_format($row['Monto'],2,'.',','); ?></td>
                    <?php } ?>
                    <tr>
                        <th>Total:</th>
                        <td><?php echo "$".number_format($Monto,2,'.',','); ?></td>
                    </tr>
            <?php }else{ ?>
                <tr><td colspan="8" ><center>No hay resultados - lo siento</center></td></tr>
            <?php } ?> 
            
        </tbody>
    </table>
<?php 
}elseif ($_POST['tipo'] == 1) { 
    $gastos = $cierre->get_gastos_fecha($fecha_inicial.' 05:00:00',$fecha_final.' 23:59:59'); 
    ?>
    <table class='table table-striped table-bordered' id=''>
        <CENTER><h2>REPORTE DE GASTOS</h2></CENTER>
        <thead>
            <tr>
                <th>Fecha Hora</th>
                <th>Descripcion</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($gastos)>0) {
                $Monto = 0;
               foreach ($gastos as $row) { ?>
                    <tr> 
                        <td><?php echo $row['Fecha'] ?></td>
                        <td><?php echo $row['Descripcion'] ?></td>
                        <td><?php $Monto += $row['Monto']; echo "$".number_format($row['Monto'],2,'.',','); ?></td>
                    <?php } ?>
                    <tr>
                        <th colspan="2">Total:</th>
                        <td><?php echo "$".number_format($Monto,2,'.',','); ?></td>
                    </tr>
            <?php }else{ ?>
                <tr><td colspan="8" ><center>No hay resultados - lo siento</center></td></tr>
            <?php } ?> 
            
        </tbody>
    </table>
<?php 
}elseif ($_POST['tipo'] == 3) { 
    $facturas = $abonos->get_facturas_abonadas($fecha_inicial.' 05:00:00',$fecha_final.' 23:59:59');
    ?>
    <table class='table table-striped table-bordered' id=''>
        <CENTER><h2>REPORTE ABONOS</h2></CENTER>
        <thead>
            <tr>
                <th>Fecha Abono</th>
                <th>N Factura</th>
                <th>Cliente</th>
                <th>Monto Total</th>
                <th>Abono del dia</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($facturas)>0) {
                $Monto = 0;
                $Total = 0;
               foreach ($facturas as $row) { 
                    $factura_se = $encabezado_factura->get_id_factura($row['Id_factura']);
                    ?>
                    <tr style="cursor: pointer;" onclick="fact('<?php echo $row['Id_pedido'] ?>');" > 
                        <td><?php echo $row['Fecha'] ?></td>
                        <td>
                            <?php if ($factura_se[0][4]==1) {
                                echo $factura_se[0][1].' '.$row['N_ccf'];
                            }elseif ($factura_se[0][4]==0) {
                                echo $factura_se[0][1].' '.$row['N_fac'];
                            } ?>
                        </td>
                        <td>
                            <?php echo $row['Cliente']; ?>
                        </td>
                        <td>
                            <?php $Total += ($row['Total']); echo number_format(($row['Total']),2,'.',','); ?>
                        </td>
                        <td><?php $Monto += $row['Monto']; echo "$".number_format($row['Monto'],2,'.',','); ?></td>
                    <?php } ?>
                    <tr>
                        <th colspan="3">Total:</th>
                        <td><?php  echo "$".number_format($Total,2,'.',','); ?></td>
                        <td><?php  echo "$".number_format($Monto,2,'.',','); ?></td>
                    </tr>
            <?php }else{ ?>
                <tr><td colspan="8" ><center>No hay resultados - lo siento</center></td></tr>
            <?php } ?> 
            
        </tbody>
    </table>
<?php }elseif ($_POST['tipo'] == 4) { 
    $gastos = $cierre->get_egresos_fecha($fecha_inicial.' 05:00:00',$fecha_final.' 23:59:59'); 
    ?>
    <table class='table table-striped table-bordered' id=''>
        <CENTER><h2>REPORTE DE EGRESOS</h2></CENTER>
        <thead>
            <tr>
                <th>Fecha Hora</th>
                <th>Descripcion</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($gastos)>0) {
                $Monto = 0;
               foreach ($gastos as $row) { ?>
                    <tr> 
                        <td><?php echo $row['Fecha'] ?></td>
                        <td><?php echo $row['Descripcion'] ?></td>
                        <td><?php $Monto += $row['Monto']; echo "$".number_format($row['Monto'],2,'.',','); ?></td>
                    <?php } ?>
                    <tr>
                        <th colspan="2">Total:</th>
                        <td><?php echo "$".number_format($Monto,2,'.',','); ?></td>
                    </tr>
            <?php }else{ ?>
                <tr><td colspan="8" ><center>No hay resultados - lo siento</center></td></tr>
            <?php } ?> 
            
        </tbody>
    </table>
<?php 
} ?>