<?php
@session_start();
date_default_timezone_set('America/El_salvador');
include '../menu/menu.php';
include '../clases/clase_encabezado_factura.php';
$encabezado_factura = new encabezado_factura();
$encabezado_fact = $encabezado_factura->buscar_comision_vendedor(date('Y-m-d'),date('Y-m-d'));
        ?>
                    <ol class="breadcrumb">
                      <li><a onclick="contenido('view_producto.php');">Reliance</a></li>
                      <li class="active">Reporte de Ventas</li>
                    </ol>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h1 class='text-center'>REPORTE DE VENTA VENDEDOR</h1>
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
                                                <!--<div class='form-group input-group date' id='divMiCalendario'>
                                                    <input class='form-control' type="date" name="fecha_inicial" id="fecha_inicial">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar" id="Fecha"></span></span>
                                                </div>-->
                                                <input class='form-control selectpicker' type="text" name="fecha_inicial" id="fecha_inicial">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input class='form-control selectpicker' type="text" name="fecha_final" id="fecha_final">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="4"><a onclick="Generar($('#fecha_inicial').val(),$('#fecha_final').val())" class='btn btn-info'>Generar</a> <a href="#" onclick="imprimir_v()" class='btn btn-primary'>Imprimir</a>
                                                <span id="img"></span></th>
                                        </tr>
                                    </tbody>
                                </table>
                                <div id="Carga">
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
    function fecha() {
        $('#divMiCalendario').datetimepicker({
            format: 'DD-MM-YYYY'
        });
    }
    fecha();
    function imprimir_v() {
        var contenido= document.getElementById('Carga').innerHTML;
        var contenidoOriginal= document.body.innerHTML;
        document.body.innerHTML = contenido;
        window.print();
        document.body.innerHTML = contenidoOriginal;
    }
    function Generar(fecha_inicial,fecha_final){
        //alert('dfgdfg');
        $.ajax({
          url: "generar_reporte.php",
          type : 'post',
          data: {
            fecha_inicial: fecha_inicial,
            fecha_final: fecha_final,
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
</script>
