<?php
				include '../menu/menu.php';
				include '../clases/clase_mecanico.php';
				$mecanico = new mecanico();
				$data = $mecanico->get_mecanico();
		?>
					<ol class="breadcrumb">
					  <li><a onclick="contenido('view_producto.php');">Reliance</a></li>
					  <li class="active">mecanico</li>
					</ol>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h1 class='text-center'>mecanico</h1>
						</div>
						<div class="panel-body">
							<a href='add_mecanico.php' class='btn btn-info'>Nuevo mecanico</a><br><br>
							<div class='table-responsive'>
								<table class='table table-striped table-bordered' id='tabla_datos'>
									<thead>
										<tr>
											<td>Cod_mecanico</td>
											<td>Nombre</td>
											<td>Nit</td>
											<td>Direccion</td>
											<td>Telefono</td>
											<td class='text-center'><b>Opciones</b></td>
										</tr>
									</thead>
									<?php
									foreach ($data as $row) {?>
									<tr>
										<td><?php echo $row['Cod_mecanico'] ?></td>
										<td><?php echo $row['Nombre'] ?></td>
										<td><?php echo $row['Nit'] ?></td>
										<td><?php echo $row['Direccion'] ?></td>
										<td><?php echo $row['Telefono'] ?></td>
										<td><a href='add_mecanico.php?id=<?php echo $row[0] ?>' class='btn btn-info'>Editar</a></td>
									</tr>
									<?php }?>
								</table>
							</div>
						</div>
					</div>
<?php include '../pie/pie.php';  ?>
