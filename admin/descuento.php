<?php
@session_start();
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
$por = 0;
if ($_POST['dato']==0) {
    $por = 0.0;
}elseif ($_POST['dato']==1) {
    $por = 0.05;
}elseif ($_POST['dato']==2) {
    $por = 0.1;
}
if ($_POST['tipo']==0) { ?>
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
                <th colspan="4">Total</th>
                <th><?php echo '$ '.number_format(($sumas+$iva),2,'.',','); ?></th>
            </tr>
            <?php if ($por > 0) { ?>
                <tr>
                    <th colspan="4">Descuento</th>
                    <th><?php echo '$ '.number_format((($sumas+$iva)*$por),2,'.',','); ?></th>
                </tr>
            <?php } ?>
            <tr>
                <th colspan="4">Venta Total</th>
                <th><?php echo '$ '.number_format((($sumas+$iva)-(($sumas+$iva)*$por)),2,'.',','); ?></th>
            </tr>
        </tbody>
    </table>
<?php }elseif ($_POST['tipo']==1) {
    $sumas = 0;
    $iva = 0;
    for ($i=0; $i < $_SESSION['n']; $i++) {
        if ($_SESSION["p"][$i] != null) {
            $r = $_SESSION["p"][$i];
            foreach ($r as $k) {
                if($k[0] != null){
                    $sumas += res_iva(($k[1]*$k[2]),$_POST['Tipo_fac']);
                    $tt = res_iva(($k[1]*$k[2]),$_POST['Tipo_fac']);
                    $iva += iva($tt,$_POST['Tipo_fac']);
                }
            }
        }
    }
    ?>
     <div class="row">
        <input type="hidden" name='Descuento' value='<?php echo $por; ?>'>
        <div id="add-facturar-messages"></div>
        <div class='col-sm-12'>
            <div class='col-sm-6'>
                <h2><b>Suma</b></h2>
                <h2><b>Iva</b></h2>
                <h2><b>Descuento</b></h2>
                <h2><b>Total a Pagar</b></h2>
                <h2><b>Ingrese cantidad</b></h2>
                <h2><b>Cambio</b></h2>
            </div>
            <div class='col-sm-6'>
                <h2>: $<?php echo number_format($sumas,2,'.',','); ?><br></h2>
                <h2>: $<?php echo number_format($iva,2,'.',',')?></h2>
                <h2>: $<?php echo number_format((($sumas+$iva)*$por),2,'.',',')?></h2>
                <h2>: $<?php echo number_format((($sumas+$iva)-(($sumas+$iva)*$por)),2,'.',','); ?><br></h2>
                <h2><input type='text' name='Ingrese cantidad' id='Ingrese cantidad' onchange='cambio($(this).val(),<?php echo (($sumas+$iva)-(($sumas+$iva)*$por)); ?>)' class='form-control' placeholder='Ingrese cantidad' required></h2>
                <h2 id='cambios'>: $<?php echo number_format(0,2,'.',','); ?><br></h2>
            </div>
        </div>
    </div>
<?php }
?>
