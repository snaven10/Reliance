<?php
				if (!isset($_POST['validacion'])) {
					if (basename($_SERVER["PHP_SELF"]) != 'index.php') {
						header('location: ../admin');
					}
				}
				include '../clases/clase_pedido.php';

				$pedido = new pedido();

				$data = $pedido->get_pedido();
				
								include '../clases/clase_vendedor.php';
								$vendedor = new vendedor();
								include '../clases/clase_mecanico.php';
								$mecanico = new mecanico();
		?>
					<ol class="breadcrumb">
					  <li><a onclick="contenido('view_producto.php');">Reliance</a></li>
					  <li class="active">pedido</li>
					</ol>
					<div class="panel panel-primary"> 
						<div class="panel-heading"> 
							<h1 class='text-center'>pedido</h1>
						</div> 
						<div class="panel-body"> 
							<a href='add_pedido.php' class='btn btn-info'>Nuevo pedido</a><br><br>
							<div class='table-responsive'>
								<table class='table table-striped table-bordered' id='tabla_datos'>
									<thead>
										<tr> 
											<td>Id_pedido</td>
									<td>Id_vendedor</td>
									<td>Id_mecanico</td>
									<td>Id_cliente</td>  
											<td class='text-center'><b>Opciones</b></td>
										</tr>
									</thead>
									<?php
									foreach ($data as $row) {?>
									<tr> 
										<td><?php echo $row['Id_pedido'] ?></td>
								<td><?php $vendedor1 = $vendedor->get_id_vendedor($row['Id_vendedor']); echo $vendedor1[0][2] ?></td>
								<td><?php $mecanico1 = $mecanico->get_id_mecanico($row['Id_mecanico']); echo $mecanico1[0][2] ?></td>
								<td><?php echo $row['Id_cliente'] ?></td>
										<td><a href='add_pedido.php?id=<?php echo $row[0] ?>' class='btn btn-info'>Editar</a>&nbsp;&nbsp;&nbsp;<a href='del_pedido.php?id=<?php echo $row[0] ?>' class='btn btn-danger'>Eliminar</a></td>				
									</tr>
									<?php }?>
								</table>
							</div>	 
						</div> 
					</div>
		