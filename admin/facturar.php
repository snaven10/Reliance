<?php
if(!isset($_POST['Nombre_cl'])){ ?>
    <script>alert('Ocurrio un error!');location.href='view_producto.php';</script>
<?php }
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
                include '../menu/menu.php';
                //include 'imprimir_factura.php';
                include '../clases/clase_producto.php';
                $producto = new producto();
                $data = $producto->get_producto();

                include '../clases/clase_proveedor.php';
                $proveedor = new proveedor();
                include '../clases/clase_ubicacion.php';
                $ubicacion = new ubicacion();
                include '../clases/clase_precio.php';
                $precio = new precio();
                include '../clases/clase_factura.php';
                $factura = new factura();
                $numero = $factura->ultimo($_POST['Tipo_fac']);
                include '../clases/clase_comicion.php';
                $comicion = new comicion();
                $comision_m = $comicion->buscar_comicion($_POST['Id_mecanico'],0);
        ?>
                    <ol class="breadcrumb">
                      <li><a  href="../admin/" style="cursor: pointer;">Reliance</a></li>
                      <li class="active">Facturacion</li>
                    </ol>
                    <div class="panel panel-primary">

                        <div class="panel-body">
                            <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                <h4>
                                    <div class="col-xs-6">
                                        <b>Cliente:</b>
                                        <?php echo $_POST['Nombre_cl']; ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php if ($_POST['Nombre_ve']!='') { ?>
                                            <b>Vendedor:</b>
                                            <?php echo $_POST['Nombre_ve']; ?>
                                        <?php } ?>
                                    </div>
                                    <div class="col-xs-6">
                                            <?php if ($_POST['Nombre_me']!='') { ?>
                                                <b>Mecanico:</b>
                                                <?php echo $_POST['Nombre_me']; ?>
                                            <?php } ?>
                                    </div>
                                    <div class="col-xs-12" style='margin-top: 2mm;' >
                                        <div class='col-xs-4'>
                                            <select class='form-control' name="desc" id="desc" onchange="descuento($(this).val(),<?php echo $_POST['Tipo_fac']; ?>);">
                                                <option value="0" >seleciones Descuento</option>
                                                <option value="1" >5%</option>
                                                <option value="2" >10%</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-4">
                                                <?php if ($_POST['Nombre_me']!='') { ?>
                                                    <select class='form-control' name="Comision" id="Comision" onchange='$("#Comision_mecanico").val($(this).val());'>
                                                        <option value="0" >seleciones Comision</option>
                                                        <?php 
                                                        foreach ($comision_m as $k) { ?>
                                                            <option value="<?php echo $k['Comicion'] ?>" ><?php echo $k['Comicion'] ?>%</option>
                                                        <?php } ?>
                                                    </select>
                                                <?php } ?>
                                        </div>
                                        <div class='col-xs-3'>
                                            <?php if($_POST['Tipo_fac']==0){ ?>
                                                <div class="input-group">
                                                    <span class="input-group-addon">N Factura</span>
                                                    <input type="text" value="<?php echo $numero[0][6]; ?>" class="form-control" disabled>
                                                    <span class="input-group-addon"><?php $retVal = ($_POST['Forma_pago']==1) ? "Contado" : "Credito"; echo $retVal; ?></span>
                                                </div>
                                            <?php }elseif($_POST['Tipo_fac']==1){ ?>
                                                <div class="input-group">
                                                    <span class="input-group-addon">N CCF </span>
                                                    <input type="text" value="<?php echo $numero[0][6]; ?>" class="form-control" disabled>
                                                    <span class="input-group-addon"><?php $retVal = ($_POST['Forma_pago']==1) ? "Contado" : "Credito"; echo $retVal; ?></span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class='col-xs-1'>
                                            <input type="submit"  data-toggle="modal" id="Btn_Modal_cobrar" data-target="#Modal_cobrar"  class='btn btn-success' value='Facturar'>
                                        </div>
                                    </div>
                                </h4>
                                <!--<div class="col-xs-6"><br>
                                    <a href="" class='btn btn-success' onclick='imprSelec()'>Facturar</a>
                                </div>-->
                            </div>
                            <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                <div class='table-responsive' id='descuento' style="margin-top: 1%">
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
                                            $sumas = 0;
                                            $iva = 0;
                                            for ($i=0; $i < $_SESSION['n']; $i++) {
                                                if ($_SESSION["p"][$i] != null) {
                                                    $r = $_SESSION["p"][$i];
                                                    foreach ($r as $k) {
                                                        if($k[0] != null){ ?>
                                                            <tr>
                                                                <td><?php echo $k[3]; ?></td>
                                                                <td><?php echo $k[4]; ?></td>
                                                                <td><?php echo $k[1]; ?></td>
                                                                <td><?php echo '$ '.number_format(res_iva($k[2],$_POST['Tipo_fac']),2,'.',','); ?></td>
                                                                <td><?php echo '$ '.number_format(res_iva(($k[1]*$k[2]),$_POST['Tipo_fac']),2,'.',','); ?></td>
                                                            </tr>
                                                        <?php
                                                        $sumas += res_iva(($k[1]*$k[2]),$_POST['Tipo_fac']);
                                                        $tt = res_iva(($k[1]*$k[2]),$_POST['Tipo_fac']);
                                                        $iva += iva($tt,$_POST['Tipo_fac']);
                                                        }
                                                    }
                                                }
                                            } ?>
                                            <tr>
                                                <th colspan="4">Sumas</th>
                                                <th><?php echo '$ '.number_format($sumas,2,'.',','); ?></th>
                                            </tr>
                                            <tr>
                                                <th colspan="4">Iva</th>
                                                <th><?php echo '$ '.number_format($iva,2,'.',',') ?></th>
                                            </tr>
                                            <tr>
                                                <th colspan="4">Venta Total</th>
                                                <th><?php echo '$ '.number_format(($sumas+$iva),2,'.',','); ?></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<?php include '../pie/pie.php'; ?>

