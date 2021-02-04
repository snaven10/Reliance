<?php
@session_start();
date_default_timezone_set('America/El_salvador');
include '../menu/menu.php';
include '../clases/clase_encabezado_factura.php';
$encabezado_factura = new encabezado_factura();
include '../clases/clase_abonos.php';
$abonos = new abonos();
$facturas = $abonos->get_facturas_abonadas(date('Y-m-d').' 05:00:00',date('Y-m-d H:i:s'));
//*H:i:s
        ?>
                    <ol class="breadcrumb">
                      <li><a onclick="contenido('view_producto.php');">Reliance</a></li>
                      <li class="active">Abonos del Dia</li>
                    </ol>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h1 class='text-center'>Reporte Abonos del Dia</h1>
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
                                        </tr>
                                        <tr>
                                            <th colspan="6"><a onclick="Generar($('#fecha_inicial').val(),$('#fecha_final').val(),$('#filtro').val())" class='btn btn-info'>Generar</a> <a href="#" onclick="imprimir_v()" class='btn btn-primary'>Imprimir</a>
                                                <span id="img"></span></th>
                                        </tr>
                                    </tbody>
                                </table>
                                <div id="Carga">
                                    <table class='table table-striped table-bordered' id=''>
                                        <CENTER><h2>REPORTE ABONOS DEL DIA <?php echo date('d-m-Y'); ?></h2></CENTER>
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
          url: "generar_reporte_efectivos.php",
          type : 'post',
          data: {
            fecha_inicial: fecha_inicial,
            fecha_final: fecha_final,
            filtros: filtros,
            tipo: 3
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
