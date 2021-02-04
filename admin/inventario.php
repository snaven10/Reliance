<?php
	include '../menu/menu.php';
	include '../clases/clase_ubicacion.php';
	$ubicacion = new ubicacion();
	$data_ubicacion = $ubicacion->get_ubicacion_dist();
	?>
	<ol class="breadcrumb">
					  <li><a  href="../admin/" style="cursor: pointer;">Reliance</a></li>
					  <li class="active">Inventario</li>
					</ol>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h1 class='text-center'>Reporte de control de Inventario</h1>
						</div>
						<div class="panel-body">
							<table class='no_imprimir table table-striped table-bordered' id=''>
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                POR ESTANTE
                                            </th>
                                            <th></th>
                                            <th>
                                                POR CODIGO
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <input list="b_ubicacion" class="form-control" placeholder='Estante' id="Estante">
												<datalist id="b_ubicacion">
													<?php
														foreach ($data_ubicacion as $row){ ?>
															<option value="<?php echo $row['Estante'] ?>"></option>
														<?php } ?>
												</datalist><br>
												<center>
													<a onclick="inventario($('#Estante').val(),1)" class='btn btn-info'>Generar</a>
												</center>
                                            </td>
                                            <td>
                                            	<center>
													<a onclick="imprimir()" class='btn btn-success'>Imprimir</a>
												</center>
                                            </td>
                                            <td>
                                                <input class='form-control' type="text" name="Codigo" placeholder='Codigo' id="Codigo"><br>
												<center>
													<a onclick="inventario($('#Codigo').val(),2)" class='btn btn-info'>Generar</a>
												</center>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
							<div class='table-responsive' style="margin-top: 1%" id="imp_inventario">
								
							</div>
						</div>
					</div>
<?php include '../pie/pie.php'; ?>
