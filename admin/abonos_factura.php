<?php
@session_start();
date_default_timezone_set('America/El_salvador');
include '../menu/menu.php';
include '../clases/clase_abonos.php';
$abonos = new abonos();
$pendientes = $abonos->get_encabezado_facturas_pendientes();
$abonadas = $abonos->get_encabezado_facturas_abonadas();
$canseladas = $abonos->get_encabezado_facturas_canseladas();
        ?>
                    <ol class="breadcrumb">
                      <li><a onclick="contenido('view_producto.php');">Reliance</a></li>
                      <li class="active">Facturas al credito</li>
                    </ol>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h1 class='text-center'>Facturas al credito</h1>
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active Pen" style="cursor: pointer;"><a onclick="$('.Ab').removeClass('active');$('.Can').removeClass('active');$('.Pen').addClass('active');$('#pendientes').show();$('#abonos').hide();$('#canseladas').hide();">Pendientes</a></li>
                                <li class="Ab" style="cursor: pointer;"><a onclick="$('.Pen').removeClass('active');$('.Can').removeClass('active');$('.Ab').addClass('active');$('#pendientes').hide();$('#abonos').show();$('#canseladas').hide();">Abonos</a></li>
                                <li class="Can" style="cursor: pointer;"><a onclick="$('.Ab').removeClass('active');$('.Pen').removeClass('active');$('.Can').addClass('active');$('#pendientes').hide();$('#abonos').hide();$('#canseladas').show();">Canseladas</a></li>
                            </ul>

                            <!-- Pendientes -->

                            <div class="col-sm-12" id="pendientes">
                                <div class='table-responsive' style="margin-top: 1%">
                                    <center><b>Pendientes</b></center>
                                    <table class='table table-bordered table-hover tabla_datos'>
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Factura N°</th>
                                                <th>Cliente</th>
                                                <th>Monto</th>
                                                <th>Descuento</th>
                                                <th>Monto Total</th>
                                                <th>Abono Total</th>
                                                <th>Monto Pendiente</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody  class="result">
                                            <?php if (count($pendientes)>0) {
                                                foreach ($pendientes as $row) { ?>
                                                    <tr <?php if ($row['Compra_total'] == $row['Abono']) { ?> class="info" style="cursor: pointer;" <?php }elseif(($row['Compra_total']-$row['Abono']) < $row['Compra_total'] AND $row['Abono'] > 0){
                                                        ?> class="success" style="cursor: pointer;"<?php }else{ ?> class="danger" style="cursor: pointer;"<?php } ?> onclick="modal_abonos('<?php echo $row['Id_encabezado_factura'] ?>');" >
                                                        <td><?php echo $row['Fecha']; ?></td>
                                                        <td><?php echo  ($row['N_fac']==0) ? $row['Serie']." ".$row['N_ccf'] : $row['Serie']." ".$row['N_fac'] ; ?></td>
                                                        <td><?php echo $row['Cliente']; ?></td>
                                                        <td><?php echo "$".number_format($row['Compra_total'],2,'.',','); ?></td>
                                                        <td><?php echo "$".number_format($row['Descuento_compra'],2,'.',','); ?></td>
                                                        <td><?php echo "$".number_format(($row['Compra_total']-$row['Descuento_compra']),2,'.',','); ?></td>
                                                        <td><?php echo "$".number_format($row['Abono'],2,'.',','); ?></td>
                                                        <td><?php echo "$".number_format((($row['Compra_total']-$row['Descuento_compra'])-$row['Abono']),2,'.',','); ?></td>
                                                        <td><?php echo  (($row['Compra_total']-$row['Abono']) == 0) ? 'Canselado' : 'pendiente' ; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>                                             
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Abonos -->

                            <div class="col-sm-12" id="abonos" hidden="hidden">
                                <div class='table-responsive' style="margin-top: 1%">
                                    <center><b>Abonos</b></center>
                                    <table class='table table-bordered table-hover tabla_datos'>
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Factura N°</th>
                                                <th>Cliente</th>
                                                <th>Monto</th>
                                                <th>Descuento</th>
                                                <th>Monto Total</th>
                                                <th>Abono Total</th>
                                                <th>Monto Pendiente</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody  class="result">
                                            <?php if (count($abonadas)>0) {
                                                foreach ($abonadas as $row) { ?>
                                                    <tr <?php if ($row['Compra_total'] == $row['Abono']) { ?> class="info" style="cursor: pointer;" <?php }elseif(($row['Compra_total']-$row['Abono']) < $row['Compra_total'] AND $row['Abono'] > 0){
                                                        ?> class="success" style="cursor: pointer;"<?php }else{ ?> class="danger" style="cursor: pointer;"<?php } ?> onclick="modal_abonos('<?php echo $row['Id_encabezado_factura'] ?>');" >
                                                        <td><?php echo $row['Fecha']; ?></td>
                                                        <td><?php echo  ($row['N_fac']==0) ? $row['Serie']." ".$row['N_ccf'] : $row['Serie']." ".$row['N_fac'] ; ?></td>
                                                        <td><?php echo $row['Cliente']; ?></td>
                                                        <td><?php echo "$".number_format($row['Compra_total'],2,'.',','); ?></td>
                                                        <td><?php echo "$".number_format($row['Descuento_compra'],2,'.',','); ?></td>
                                                        <td><?php echo "$".number_format(($row['Compra_total']-$row['Descuento_compra']),2,'.',','); ?></td>
                                                        <td><?php echo "$".number_format($row['Abono'],2,'.',','); ?></td>
                                                        <td><?php echo "$".number_format((($row['Compra_total']-$row['Descuento_compra'])-$row['Abono']),2,'.',','); ?></td>
                                                        <td><?php echo  (($row['Compra_total']-$row['Abono']) == 0) ? 'Canselado' : 'pendiente' ; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>                                             
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <!-- Canseladas -->

                            <div class="col-sm-12" id="canseladas" hidden="hidden">
                                <div class='table-responsive' style="margin-top: 1%">
                                    <center><b>Canselados</b></center>
                                    <table class='table table-bordered table-hover tabla_datos'>
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Factura N°</th>
                                                <th>Cliente</th>
                                                <th>Monto</th>
                                                <th>Descuento</th>
                                                <th>Monto Total</th>
                                                <th>Abono Total</th>
                                                <th>Monto Pendiente</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody  class="result">
                                            <?php if (count($canseladas)>0) {
                                                foreach ($canseladas as $row) { ?>
                                                    <tr <?php if ($row['Compra_total'] == $row['Abono']) { ?> class="info" style="cursor: pointer;" <?php }elseif(($row['Compra_total']-$row['Abono']) < $row['Compra_total'] AND $row['Abono'] > 0){
                                                        ?> class="success" style="cursor: pointer;"<?php }else{ ?> class="danger" style="cursor: pointer;"<?php } ?> onclick="modal_abonos('<?php echo $row['Id_encabezado_factura'] ?>');" >
                                                        <td><?php echo $row['Fecha']; ?></td>
                                                        <td><?php echo  ($row['N_fac']==0) ? $row['Serie']." ".$row['N_ccf'] : $row['Serie']." ".$row['N_fac'] ; ?></td>
                                                        <td><?php echo $row['Cliente']; ?></td>
                                                        <td><?php echo "$".number_format($row['Compra_total'],2,'.',','); ?></td>
                                                        <td><?php echo "$".number_format($row['Descuento_compra'],2,'.',','); ?></td>
                                                        <td><?php echo "$".number_format(($row['Compra_total']-$row['Descuento_compra']),2,'.',','); ?></td>
                                                        <td><?php echo "$".number_format($row['Abono'],2,'.',','); ?></td>
                                                        <td><?php echo "$".number_format((($row['Compra_total']-$row['Descuento_compra'])-$row['Abono']),2,'.',','); ?></td>
                                                        <td><?php echo  (($row['Compra_total']-$row['Abono']) == 0) ? 'Canselado' : 'pendiente' ; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>                                             
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<script type="text/javascript">
    $('.tabla_datos').DataTable( {
        "language": {
            "lengthMenu": "Mostrar _MENU_ Registros por pagina",
            "zeroRecords": "No hay resultados - lo siento",
            "info": "Mostrando _PAGE_ de _PAGES_ paginas",
            "infoEmpty": "No hay resultados - lo siento",
            "sSearch": "Buscar: ",
            "infoFiltered": "( En _MAX_ Registros)"
        }
    } );
</script>
<?php
include '../pie/pie.php'; ?>