<?php
@session_start();
date_default_timezone_set('America/El_salvador');
include '../menu/menu.php';
include '../clases/clase_encabezado_factura.php';
$encabezado_factura = new encabezado_factura();
$encabezado_fact = $encabezado_factura->buscar_encabezado_factura_fecha(date('Y-m-d'),date('Y-m-d'),0);
        ?>
    <ol class="breadcrumb">
      <li><a onclick="contenido('view_producto.php');">Reliance</a></li>
      <li class="active">Reporte de Ventas</li>
    </ol>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 class='text-center'>Reporte de Ventas</h1>
        </div>
        <div class="panel-body">
            <div class='table-responsive'>
                <table class='no_imprimir table table-striped table-bordered' id=''>
                    <thead>
                        <tr>
                            <th colspan="2">
                                Fecha incial
                            </th>
                            <th></th>
                            <th>
                                Fecha final
                            </th>
                            <th></th>
                            <th>
                                Filtros
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <input class='form-control selectpicker' type="text" name="fecha_inicial" id="fecha_inicial">
                            </td>
                            <td></td>
                            <td>
                                <input class='form-control selectpicker' type="text" name="fecha_final" id="fecha_final">
                            </td>
                            <td></td>
                            <td>
                                <select name="filtro" class="form-control" id="filtro">
                                    <option value="0">General</option>
                                    <option value="1">Credito Fiscal</option>
                                    <option value="2">Consumidor final</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="6"><a onclick="Generar($('#fecha_inicial').val(),$('#fecha_final').val(),$('#filtro').val())" class='btn btn-info'>Generar</a> <a href="#" onclick="imprimir_v()" class='btn btn-primary'>Imprimir</a>
                                <span id="img"></span></th>
                        </tr>
                    </tbody>
                </table>
                <div id="Carga">
                    <table class='table table-striped table-bordered' id=''>
                        <CENTER><h2>REPORTE DE VENTAS <?php echo date('d-m-Y'); ?></h2></CENTER>
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
                                    <tr <?php if ($row['Estado'] == 0) { echo 'style="cursor: pointer; color: red;"'; }elseif($row['Condicon_operacion']==2){ echo 'style="cursor: pointer; color: red;"'; }else{
                                        ?> style="cursor: pointer;"<?php } ?>  onclick="fact('<?php echo $row['Id_pedido'] ?>');" >
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
                </div>
            </div>
        </div>
    </div>
<?php
include '../pie/pie.php'; ?>
<script type="text/javascript">
    $('.selectpicker').datepicker({
        format: 'yyyy-mm-dd'
    });
    function imprimir_v() {
        var contenido= document.getElementById('Carga').innerHTML;
        var contenidoOriginal= document.body.innerHTML;
        document.body.innerHTML = contenido;
        window.print();
        document.body.innerHTML = contenidoOriginal;
    }
    function Generar(fecha_inicial,fecha_final,filtros){
        //alert('dfgdfg');
        $.ajax({
          url: "generar_reporte.php",
          type : 'post',
          data: {
            fecha_inicial: fecha_inicial,
            fecha_final: fecha_final,
            filtros: filtros,
            tipo: 0
          },
          beforeSend: function(){
            $('#img').html("<img src='../img/cargando.gif' width=30 height=30/>");
          },
          success: function( result ) {
            $('#Carga').html(result);
            $('#img').html("");
          }
        });
    }
    function fact(id) {
        $.ajax({
          url: "generar_reporte.php",
          type : 'post',
          data: {
            id: id,
            tipo: 2
          },
          beforeSend: function(){
            $('#img').html("<img src='../img/cargando.gif' width=30 height=30/>");
          },
          success: function( result ) {
            $('#Modal_vista_factura_contenido').html(result);
            $('#Modal_vista_factura').show();
            $('#img').html("");
          }
        });
    }
</script>
