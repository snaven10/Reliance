<?php
function res_iva($value,$tipo)
{
    if ($tipo==0) {
        return ($value / 1.13);
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
@session_start();
date_default_timezone_set('America/El_salvador');
include '../clases/clase_factura.php';
$factura = new factura();
$numero = $factura->ultimo($_POST['Tipo_fac']);
//echo $_POST['Nombre_cl'];
if (!empty($_POST['correlativo']) && $_POST['correlativo'] == $numero[0][6]) {
    if (!empty($_POST['Nombre_cl'])) {
        if ($_POST['operacion']==2) {
            include '../clases/clase_cliente.php';
            $cliente = new cliente();
            if ($cliente->add_cliente(2,$_POST['Nombre_cl'],1) == 0) {
                $cliente = null;
                $cliente = new cliente();
                $ultimo = $cliente->ultimo();
                $id_cliente = $ultimo[0][0];
            }else{ ?>
                <script>alert('Ocurrio un error!');</script>
            <?php }
        }elseif($_POST['operacion']==1) {
            $id_cliente = $_POST['Id_cliente'];
        }
        if(!empty($_POST['Id_vendedor'])){
            $Id_vendedor = $_POST['Id_vendedor'];
        }elseif(empty($_POST['Id_vendedor'])){
            $Id_vendedor = 0;
        }
        if(!empty($_POST['Id_mecanico'])){
            $Id_mecanico = $_POST['Id_mecanico'];
        }elseif(empty($_POST['Id_mecanico'])){
            $Id_mecanico = 0;
        }
        include '../clases/clase_pedido.php';
        $pedido = new pedido();
        if ($pedido->add_pedido($Id_vendedor,$Id_mecanico,$id_cliente,1) == 0) {
            $pedido = null;
            $pedido = new pedido();
            $ultimo = $pedido->ultimo();
            $id_pedido = $ultimo[0][0];
            include '../clases/clase_detalle_venta.php';
            include '../clases/clase_precio.php';
            $detalle_venta = new detalle_venta();
            $venta_total = 0;
            for ($i=0; $i < $_SESSION['n']; $i++) {
                if ($_SESSION["p"][$i] != null) {
                    $r = $_SESSION["p"][$i];
                    foreach ($r as $k) {
                        if($k[0] != null){
                            if ($detalle_venta->add_detalle_venta($id_pedido,$k[0],$k[1],$k[5],$k[2],1) == 0) {
                                $detalle_venta = null;
                                $detalle_venta = new detalle_venta();
                                $venta_total += ($k[2] * $k[1]);
                                $precio = new precio();

                                if ($precio->edit_precio_fac($k[0],$k[1]) == 0) {
                                     $precio = null;
                                }else{ ?>
                                    <script>alert('Ocurrio un error!');</script>
                                <?php }
                                
                            }else{ ?>
                                <script>alert('Ocurrio un error!');</script>
                            <?php }
                        }
                    }
                }
            }
            include '../clases/clase_comicion.php';
            $comicion = new comicion();
            $comision_m = $_POST['Comision_mecanico'];
            $comision_mecanico = number_format((($comision_m/100)*(res_iva(($venta_total-$_POST['Descuento']),$_POST['Tipo_fac']))),2,'.',',');
            $comicion = null;
            $comicion = new comicion();
            $comision_v = $comicion->buscar_comicion(0,$_POST['Id_vendedor']);
            $comision_vendedor = number_format((($comision_v[0][3]/100)*(res_iva(($venta_total-$_POST['Descuento']),$_POST['Tipo_fac']))),2,'.',',');

            $fecha = date('Y-m-d');
            $fecha_v = strtotime('+15 day',strtotime($fecha));
            $fecha_v = date('Y-m-d',$fecha_v);
            //include '../clases/clase_factura.php';
            $factura = new factura();
            $numero = $factura->ultimo($_POST['Tipo_fac']);
            $Abono = 0;
            if($_POST['Tipo_fac']==0){
                $N_fac = $numero[0][6];
                $N_ccf = 0;
            }elseif($_POST['Tipo_fac']==1){
                $N_fac = 0;
                $N_ccf = $numero[0][6];
            }
            if ($_POST['Forma_pago'] == 1) {
                $Abono = $venta_total;
            } elseif ($_POST['Forma_pago'] == 2) {
                $Abono = 0;
            } 
            
            if ($factura->edit_facturas_c($numero[0][0],$numero[0][6]) == 0)
            {
                include '../clases/clase_encabezado_factura.php';
                $encabezado_factura = new encabezado_factura();
                if ($encabezado_factura->add_encabezado_factura($numero[0][0],$N_fac,$N_ccf,$fecha,$fecha_v,$_POST['Descuento'],$comision_mecanico,$comision_vendedor,$Abono,$venta_total,$_POST['Forma_pago'],$_SESSION['Id'],$id_pedido,1) == 0) { ?>
                    <script>window.open('imprimir_factura.php?ped=<?php echo $id_pedido; ?>');</script>
                   <!-- <script>location.href='imprimir_factura.php?ped=< ?php echo $id_pedido; ?>';</script>-->
                <?php }else{ ?>
                    <script>alert('Ocurrio un error!');location.href='view_producto.php';</script>
                <?php }
            }else{ ?>
                <script>alert('Ocurrio un error!');location.href='view_producto.php';</script>
            <?php }
        }else{ ?>
            <script>alert('Ocurrio un error!');</script>

        <?php }
} else { ?>
    <script>location.href='view_producto.php';</script>
<?php }
$_SESSION['p'] = null;
$_SESSION['n'] = 0;
}
?>
