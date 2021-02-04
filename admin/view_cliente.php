<?php
				include '../menu/menu.php';
				include '../clases/clase_cliente.php';

				$cliente = new cliente();

				$data = $cliente->get_cliente();
				
		?>
					<ol class="breadcrumb">
					  <li><a onclick="contenido('view_producto.php');">Reliance</a></li>
					  <li class="active">cliente</li>
					</ol>
					<div class="panel panel-primary"> 
						<div class="panel-heading"> 
							<h1 class='text-center'>cliente</h1>
						</div> 
						<div class="panel-body"> 
							<a href="add_cliente.php" class='btn btn-info'>Nuevo cliente</a><br><br>
							<div class='table-responsive'>
								<table class='table table-striped table-bordered' id='tabla_datos'>
									<thead>
										<tr> 
											<td>Cod_cliente</td>
											<td>Nombre</td>
											<td>Direccion</td>
											<td>NRC</td>
											<td>NIT</td>
											<td>Telefono</td>
											<td class='text-center'><b>Opciones</b></td>
										</tr>
									</thead>
									<?php
									foreach ($data as $row) {?>
									<tr> 
										<td><?php echo $row['Cod_cliente'] ?></td>
										<td><?php echo $row['Nombre'] ?></td>
										<td><?php echo $row['Direccion'] ?></td>
										<td><?php echo $row['Nrc'] ?></td>
										<td><?php echo $row['Nit'] ?></td>
										<td><?php echo $row['Telefono'] ?></td>
										<td><a href='add_cliente.php?id=<?php echo $row[0] ?>' class='btn btn-info'>Editar</a></td>				
									</tr>
									<?php }?>
								</table>
							</div>	 
						</div> 
					</div>
<?php include '../pie/pie.php';  ?>
		