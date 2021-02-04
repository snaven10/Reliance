<?php
@session_start();
include '../clases/clase_encabezado_factura.php';
$encabezado_factura = new encabezado_factura();
if ($_POST['tipo'] == 0) {
    $fecha_inicial = $_POST['fecha_inicial'];
    $fecha_inicial = new DateTime($fecha_inicial);
    $fecha_inicial = $fecha_inicial->format('Y-m-d');
    $fecha_final = $_POST['fecha_final'];
    $fecha_final = new DateTime($fecha_final);
    $fecha_final = $fecha_final->format('Y-m-d');
    $filtros = $_POST['filtros'];
    //echo "<script>alert('".$filtros."');</script>";
    // print_r($fecha_inicial);
    // print_r("<br>");
    // print_r($fecha_final);
    $encabezado_fact = $encabezado_factura->buscar_encabezado_factura_fecha($fecha_inicial,$fecha_final,$filtros);
    ?>
    <table class='table table-striped table-bordered' id=''>
        <CENTER><h2>REPORTE DE VENTAS <?php  if (count($encabezado_fact)>0) { echo $encabezado_fact[0]['Fecha']; } ?></h2></CENTER>
        <thead>
            <tr>
                <th>Factura N°</th>
                <th>Total</th>
                <th>Iva</th>
                <?php if ($_SESSION['Nivel'] ==3 && isset($_SESSION['Id']) && isset($_SESSION['Nivel'])) { ?>
                    <th>Compra</th>
                    <th>Iva</th>
                    <th>Utilidad Bruta</th>
                <?php } ?>
                <th>Comision Mecanico</th>
                <?php if ($_SESSION['Nivel'] ==3 && isset($_SESSION['Id']) && isset($_SESSION['Nivel'])) { ?>
                    <th>Comision Vendedor</th>
                    <th>Utilidad Neta</th>
                <?php } ?>
                    <th>Condicion de Pago</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($encabezado_fact)>0) {
                $Total = 0;
                $Iva = 0;
                $Iva_c = 0;
                $Precio_c = 0;
                $Utilidad_bruta = 0;
                $Comision_m = 0;
                $Comision_v = 0;
                $Utilidad_neta = 0;
               foreach ($encabezado_fact as $row) {
                    $factura_se = $encabezado_factura->get_id_factura($row['Id_factura']);
                        ?>
                    <tr  <?php if ($row['Estado'] == 0) { echo 'style="cursor: pointer; color: red;"';}elseif($row['Condicon_operacion']==2){ echo 'style="cursor: pointer; color: red;"'; }else{ ?> style="cursor: pointer;"<?php } ?>  onclick="fact('<?php echo $row['Id_pedido'] ?>');" >
                        <td>
                            <?php if ($factura_se[0][4]==1) {
                                echo $factura_se[0][1].' '.$row['N_ccf'];
                            }elseif ($factura_se[0][4]==0) {
                                echo $factura_se[0][1].' '.$row['N_fac'];
                            } ?>

                        </td>
                        <td>
                            <?php $Total += ($row['Total']); echo number_format(($row['Total']),2,'.',','); ?>
                        </td>
                        <td>
                            <?php $Iva += ($row['Iva']); echo number_format(($row['Iva']),2,'.',','); ?>
                        </td>
                        <?php if ($_SESSION['Nivel'] ==3 && isset($_SESSION['Id']) && isset($_SESSION['Nivel'])) { ?>
                            <td>
                                <?php $Precio_c += ($row['Precio_c']);  echo number_format(($row['Precio_c']),2,'.',','); ?>
                            </td>
                            <td>
                                <?php $Iva_c += ((($row['Precio_c']/1.13)*0.13));  echo number_format(((($row['Precio_c']/1.13)*0.13)),2,'.',','); ?>
                            </td>
                            <td>
                                <?php  $Utilidad_bruta += ((($row['Total']-$row['Precio_c']-$row['Iva'])+(($row['Precio_c']/1.13)*0.13))); echo number_format(((($row['Total']-$row['Precio_c']-$row['Iva'])+(($row['Precio_c']/1.13)*0.13))),2,'.',','); ?>
                            </td>
                        <?php } ?>
                        <td>
                            <?php $Comision_m += $row['Comision_m']; echo number_format($row['Comision_m'],2,'.',','); ?>
                        </td>
                        <?php if ($_SESSION['Nivel'] ==3 && isset($_SESSION['Id']) && isset($_SESSION['Nivel'])) { ?>
                            <td>
                                <?php $Comision_v += $row['Comision_v']; echo number_format($row['Comision_v'],2,'.',','); ?>
                            </td>
                            <td>
                                <?php $Utilidad_neta += ((($row['Total']-$row['Precio_c']-$row['Iva']-$row['Comision_m']-$row['Comision_v'])+(($row['Precio_c']/1.13)*0.13))); echo number_format(((($row['Total']-$row['Precio_c']-$row['Iva']-$row['Comision_m']-$row['Comision_v'])+(($row['Precio_c']/1.13)*0.13))),2,'.',','); ?>
                            </td>
                        <?php } ?>
                            <td> <?php $retVal = ($row['Condicon_operacion']==1) ? "Contado" : "Credito"; echo $retVal; ?></td>
                    </tr> 
                    <?php } ?>
                    <tr>
                        <th>Total:</th>
                        <th><?php echo number_format($Total,2,'.',','); ?></th>
                        <th><?php echo number_format($Iva,2,'.',','); ?></th>
                        <?php if ($_SESSION['Nivel'] ==3 && isset($_SESSION['Id']) && isset($_SESSION['Nivel'])) { ?>
                            <th><?php echo number_format($Precio_c,2,'.',','); ?></th>
                            <th><?php echo number_format($Iva_c,2,'.',','); ?></th>
                            <th><?php echo number_format($Utilidad_bruta,2,'.',','); ?></th>
                        <?php } ?>
                        <th><?php echo number_format($Comision_m,2,'.',','); ?></th>
                        <?php if ($_SESSION['Nivel'] ==3 && isset($_SESSION['Id']) && isset($_SESSION['Nivel'])) { ?>
                            <th><?php echo number_format($Comision_v,2,'.',','); ?></th>
                            <th><?php echo number_format($Utilidad_neta,2,'.',','); ?></th>
                        <?php } ?>
                            <th></th>
                    </tr>
            <?php }else{ ?>
                <tr><td colspan="8" ><center>No hay resultados - lo siento</center></td></tr>
            <?php } ?> 
            
        </tbody>
    </table>
<?php 
}elseif ($_POST['tipo'] == 1) {
    $fecha_inicial = $_POST['fecha_inicial'];
    $fecha_inicial = new DateTime($fecha_inicial);
    $fecha_inicial = $fecha_inicial->format('Y-m-d');
    $fecha_final = $_POST['fecha_final'];
    $fecha_final = new DateTime($fecha_final);
    $fecha_final = $fecha_final->format('Y-m-d');
    $encabezado_fact = $encabezado_factura->buscar_comision_mecanico($fecha_inicial,$fecha_final);
    ?>
    <table class='table table-striped table-bordered' id=''>
        <CENTER><h2>REPORTE DE COMISION MECANICO</h2></CENTER>
        <thead>
            <tr>
                <th>Nombre Mecanico</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($encabezado_fact)>0) {
               foreach ($encabezado_fact as $row) {
                        ?>
                    <tr>
                        <td>
                            <?php echo $row['Nombre']; ?>
                        </td>
                        <td>
                            <?php echo number_format(($row['Comision']),2,'.',','); ?>
                        </td>
                    </tr>
            <?php  } }else{ ?>
                <tr><td colspan="8" ><center>No hay resultados - lo siento</center></td></tr>
            <?php } ?> 
        </tbody>
    </table>
<?php 
}elseif ($_POST['tipo'] == 3) {
    $fecha_inicial = $_POST['fecha_inicial'];
    $fecha_inicial = new DateTime($fecha_inicial);
    $fecha_inicial = $fecha_inicial->format('Y-m-d');
    $fecha_final = $_POST['fecha_final'];
    $fecha_final = new DateTime($fecha_final);
    $fecha_final = $fecha_final->format('Y-m-d');
    $encabezado_fact = $encabezado_factura->buscar_comision_vendedor($fecha_inicial,$fecha_final);
    ?>
    <table class='table table-striped table-bordered' id=''>
        <CENTER><h2>REPORTE DE VENTA VENDEDOR</h2></CENTER>
        <thead>
            <tr>
                <th>Nombre Vendedor</th>
                <th>Total Venta</th>
                <th>Comision</th>
                <th>Utilidad</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($encabezado_fact)>0) {
                $Total_Venta = 0;
                $Total_Comision = 0;
                $Total_utilidad = 0;
               foreach ($encabezado_fact as $row) {
                        ?>
                    <tr>
                        <td>
                            <?php echo $row['Nombre']; ?>
                        </td>
                        <td>
                            <?php $Total_Venta += $row['Venta']; echo number_format(($row['Venta']),2,'.',','); ?>
                        </td>
                        <td>
                            <?php $Total_Comision = $Total_Comision + $row['Comision']; echo number_format(($row['Comision']),2,'.',','); ?>
                        </td>
                        <td>
                            <?php $Total_utilidad = $Total_utilidad + ((($row['Venta']-$row['Precio_c']-(($row['Venta']/1.13)*0.13)-$row['Comision_m']-$row['Comision'])+(($row['Precio_c']/1.13)*0.13))); echo number_format(((($row['Venta']-$row['Precio_c']-(($row['Venta']/1.13)*0.13)-$row['Comision_m']-$row['Comision'])+(($row['Precio_c']/1.13)*0.13))),2,'.',','); ?>

                        </td>
                    </tr>
            <?php  } ?>
                    <tr>
                        <th>Total:</th>
                        <th><?php echo number_format($Total_Venta,2,'.',','); ?></th>
                        <th><?php echo number_format($Total_Comision,2,'.',','); ?></th>
                        <th><?php echo number_format($Total_utilidad,2,'.',','); ?></th>
                    </tr>
            <?php }else{ ?>
                <tr><td colspan="8" ><center>No hay resultados - lo siento</center></td></tr>
            <?php } ?>  
        </tbody>
    </table>
<?php 
} else { 
    function res_iva($value,$tipo)
    {
        if ($tipo==0) {
            return $value;
        }elseif ($tipo==1) {
            return ($value / 1.13);
        }
    }
    function iva($value,$tipo)
    {
        if ($tipo==0) {
            return 0;
        }elseif ($tipo==1) {
            return ($value * 0.13);
        }
    }
    $detalle_venta = $encabezado_factura->buscar_detalle_venta($_POST['id']);
    $tipos = $encabezado_factura->buscar_encabezado_factura($_POST['id']);
    $Cliente = $encabezado_factura->get_pedido_cliente($_POST['id']);
    if ($tipos[0][2] == 0) {
        $Tipo_facc = 1;
    } elseif ($tipos[0][3] == 0) {
        $Tipo_facc = 0;
    } ?>
    <h4><b>CLIENTE:</b> <?php echo $Cliente[0][7]; ?> <span style="float: right;"><b>Fecha: </b> <?php $buscar_encabezado_factura = $encabezado_factura->buscar_encabezado_factura($_POST['id']); echo $buscar_encabezado_factura[0][4]; ?></span></h4>   
   <?php  
   if($Tipo_facc==0){ ?>
        <h4><b>N Factura:</b> <?php $buscar_encabezado_factura = $encabezado_factura->buscar_encabezado_factura($_POST['id']); echo $buscar_encabezado_factura[0][2]; ?><span style="float: right;"><b>Descuento: </b> <?php $buscar_encabezado_factura = $encabezado_factura->buscar_encabezado_factura($_POST['id']); echo ($buscar_encabezado_factura[0][6]*100).' %'; ?></span></h4>   
    <?php }elseif($Tipo_facc==1){ ?>
        <h4><b>N CCF:</b> <?php $buscar_encabezado_factura = $encabezado_factura->buscar_encabezado_factura($_POST['id']); echo $buscar_encabezado_factura[0][3]; ?><span style="float: right;"><b>Descuento: </b> <?php $buscar_encabezado_factura = $encabezado_factura->buscar_encabezado_factura($_POST['id']); echo ($buscar_encabezado_factura[0][6]*100).' %'; ?></span></h4> 
    <?php } ?> 
    <table class='table table-bordered table-hover' id='tabla_dato'>
        <thead>
            <tr>
                <th>Cod_producto</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody class="result">
            <?php
            $total = 0;
            $Descuento = 0;
            $sumas = 0;
            $iva = 0;
            foreach ($detalle_venta as $row) { 
                $tipo = $encabezado_factura->buscar_encabezado_factura($row['Id_pedido']);
                if ($tipo[0][2] == 0) {
                    $Tipo_fac = 1;
                } elseif ($tipo[0][3] == 0) {
                    $Tipo_fac = 0;
                }
                $Descuento = $tipo[0][6];
                $total += ($row['Cantidad']*$row['Precio_v']);
                $sumas += res_iva(($row['Cantidad']*$row['Precio_v']),$Tipo_fac);
                $tt = res_iva(($row['Cantidad']*$row['Precio_v']),$Tipo_fac);
                $iva += iva($tt,$Tipo_fac);
                $sum = res_iva($row['Precio_v'],$Tipo_fac);
                $sum_t = res_iva(($row['Cantidad']*$row['Precio_v']),$Tipo_fac);
                ?>
                <tr>
                    <td><?php $pro = $encabezado_factura->get_id_producto($row['Id_producto']); echo $pro[0][1]; ?></td>
                    <td><?php $pro = $encabezado_factura->get_id_producto($row['Id_producto']); echo $pro[0][3]; ?></td>
                    <td><?php echo $row['Cantidad']; ?></td>
                    <td><?php echo '$ '.number_format(($sum-($sum*$Descuento)),2,'.',','); ?></td>
                    <td><?php echo '$ '.number_format(($sum_t-($sum_t*$Descuento)),2,'.',','); ?></td>
                </tr>
                <?php
            } ?>
            <tr>
                <th colspan="4">Sumas</th>
                <th><?php echo '$ '.number_format(($sumas-($sumas*$Descuento)),2,'.',','); ?></th>
            </tr>
            <tr>
                <th colspan="4">Iva</th>
                <th><?php echo '$ '.number_format(($iva-(($iva*$Descuento))),2,'.',',') ?></th>
            </tr>
            <tr>
                <th colspan="4">Venta Total</th>
                <th><?php echo '$ '.number_format((($sumas+$iva)-($total*$Descuento)),2,'.',','); ?></th>
            </tr>
        </tbody>
    </table>   
<?php } ?>