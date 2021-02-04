<?php
@session_start();
date_default_timezone_set('America/El_salvador');
include '../menu/menu.php';
include '../clases/clase_cierre.php';
$cierre = new cierre();
$depositos = $cierre->get_depositos_fecha(date('Y-m-d').' 05:00:00',date('Y-m-d H:i:s'));
        ?>
                    <ol class="breadcrumb">
                      <li><a onclick="contenido('view_producto.php');">Reliance</a></li>
                      <li class="active">Reporte de Ventas</li>
                    </ol>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h1 class='text-center'>Reporte de Depositos</h1>
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
                                        <CENTER><h2>REPORTE DE DEPOSITOS <?php echo date('d-m-Y'); ?></h2></CENTER>
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
</script>
