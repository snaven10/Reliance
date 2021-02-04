<?php
	include '../menu/menu.php';
	include '../clases/clase_encabezado_factura.php';
	$Total_inventario = new encabezado_factura();
	$Total = $Total_inventario->get_total_inventario();
	?>
	<ol class="breadcrumb">
					  <li><a  href="../admin/" style="cursor: pointer;">Reliance</a></li>
					  <li class="active">Inventario</li>
					</ol>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h1 class='text-center'>Reporte Total Inventario</h1>
						</div>
						<div class="panel-body">
							<table class='no_imprimir table table-striped table-bordered' id=''>
                                    <thead>
                                        <tr>
                                            <th>
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                            	<?php echo '$'.number_format($Total[0][0],2,'.',','); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
							<div class='table-responsive' style="margin-top: 1%" id="imp_inventario">
								
							</div>
						</div>
					</div>
<?php include '../pie/pie.php'; ?>
