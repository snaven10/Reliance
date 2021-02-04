<?php
@session_start();
date_default_timezone_set('America/El_salvador');
include '../menu/menu.php';
include '../clases/clase_abonos.php';
$abonos = new abonos();
$pendientes = $abonos->get_clientes_creditos();
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
                            <div class='table-responsive' style="margin-top: 1%">
                                <center><b>Pendientes</b></center>
                                <table class='table table-bordered table-hover tabla_datos'>
                                    <thead>
                                        <tr>                                            
                                            <th>Cod Cliente</th>
                                            <th>Cliente</th>
                                            <th>Monto Total</th>
                                            <th>Abonos Totales</th>
                                            <th>Monto Pendiente</th>
                                        </tr>
                                    </thead>
                                    <tbody  class="result">
                                        <?php if (count($pendientes)>0) {
                                            foreach ($pendientes as $row) { 
                                                $datos = explode(";", $row['Datos']);
                                                if (count($datos) < 2) {
                                                    $datos[0] = 0;
                                                    $datos[1] = 0;
                                                }                                                
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['Cod_cliente']; ?></td>
                                                    <td><?php echo $row['Nombre']; ?></td>
                                                    <td><?php echo "$".number_format($datos[0],2,'.',','); ?></td>
                                                    <td><?php echo "$".number_format($datos[1],2,'.',','); ?></td>
                                                    <td><?php echo "$".number_format(($datos[0]-$datos[1]),2,'.',','); ?></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>                                             
                                    </tbody>
                                </table>
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