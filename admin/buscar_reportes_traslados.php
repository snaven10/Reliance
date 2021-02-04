<?php
				include '../menu/menu.php';
				include '../clases/clase_traslados.php';
				$traslados = new traslados();
				$data = $traslados->get_traslados();
		?>
					<script type="text/javascript" language="javascript" src="../js/funciones.js"></script>
					<ol class="breadcrumb">
					  <li><a  href="../admin/" style="cursor: pointer;">Reliance</a></li>
					  <li class="active">Traslados</li>
					</ol>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h1 class='text-center'>Traslados</h1>
						</div>
						<div class="panel-body">
							<div class='table-responsive'>
								<table class='table table-striped table-bordered' id='tabla_datos'>
									<thead>
										<tr>
											<td>Fecha</td>
											<td>Numero de traslado</td>
											<td>Numero de reporte</td>
											<td>Sucusal origen</td>
											<td class='text-center'><b>Opciones</b></td>
										</tr>
									</thead>
									<?php
									foreach ($data as $row) {?>
									<tr>
										<td><?php echo $row['Fecha'] ?></td>
										<td><?php echo $row['N_traslado'] ?></td>
										<td><?php echo $row['Numero'] ?></td>
										<td><?php echo $row['Sucursal'] ?></td>
										<td><a href="#" class='btn btn-success' onclick='Buscar_traslados(<?php echo $row[0]; ?>)' >Mostrar</a> <a href="reporte_entradas_traslados.php?imp=<?php echo $row[0]; ?>&ubicacion=0" class='btn btn-primary'>Imprimir</a></td>
									</tr>
									<?php }?>
								</table>
							</div>
						</div>
					</div>
<?php include '../pie/pie.php'; ?>
