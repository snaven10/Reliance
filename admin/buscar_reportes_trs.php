<?php
				include '../menu/menu.php';
				include '../clases/clase_traslados.php';
				$traslados = new traslados();
				$data = $traslados->get_trs();
		?>
					<script type="text/javascript" language="javascript" src="../js/funciones.js"></script>
					<ol class="breadcrumb">
					  <li><a  href="../admin/" style="cursor: pointer;">Reliance</a></li>
					  <li class="active">Salidas Traslados</li>
					</ol>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h1 class='text-center'>Salidas Traslados</h1>
						</div>
						<div class="panel-body">
							<div class='table-responsive'>
								<table class='table table-striped table-bordered' id='tabla_datos'>
									<thead>
										<tr>
											<td>Sucursal a tranferir</td>
											<td>Fecha</td>
											<td>Numero</td>
											<td class='text-center'><b>Opciones</b></td>
										</tr>
									</thead>
									<?php
									foreach ($data as $row) {?>
									<tr>
										<td><?php echo $row['Sucursal'] ?></td>
										<td><?php echo $row['Fecha'] ?></td>
										<td><?php echo $row['Numero'] ?></td>
										<td><a href="#" class='btn btn-success' onclick='Buscar_trs(<?php echo $row[0]; ?>)' >Mostrar</a> <a href="reporte_salidas.php?imp=<?php echo $row[0]; ?>&ubicacion=0" class='btn btn-primary'>Imprimir</a></td>
									</tr>
									<?php }?>
								</table>
							</div>
						</div>
					</div>
<?php include '../pie/pie.php'; ?>
