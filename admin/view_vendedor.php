<?php
				include '../menu/menu.php';
				include '../clases/clase_vendedor.php';
				$vendedor = new vendedor();
				$data = $vendedor->get_vendedor();
		?>
					<ol class="breadcrumb">
					  <li><a onclick="contenido('view_producto.php');">Reliance</a></li>
					  <li class="active">vendedor</li>
					</ol>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h1 class='text-center'>vendedor</h1>
						</div>
						<div class="panel-body">
							<a href='add_vendedor.php' class='btn btn-info'>Nuevo vendedor</a><br><br>
							<div class='table-responsive'>
								<table class='table table-striped table-bordered' id='tabla_datos'>
									<thead>
										<tr>
											<td>Cod_vendedor</td>
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
										<td><?php echo $row['Cod_vendedor'] ?></td>
										<td><?php echo $row['Nombre'] ?></td>
										<td><?php echo $row['Nit'] ?></td>
										<td><?php echo $row['Direccion'] ?></td>
										<td><?php echo $row['Telefono'] ?></td>
										<td><a href='add_vendedor.php?id=<?php echo $row[0] ?>' class='btn btn-info'>Editar</a>&nbsp;&nbsp;&nbsp;<a href='#' onclick='javascript:borrar(<?php echo $row[0] ?>);' class='btn btn-danger'>Eliminar</a></td>
									</tr>
									<?php }?>
								</table>
							</div>
						</div>
					</div>
<?php include '../pie/pie.php';  ?>
<script language='javascript'>
	function borrar(id)
	{
		swal
		({
		  title: '¿Seguro que desea eliminar este registro?',
		  text: "¡No podras revertir esto!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancelar',
		  confirmButtonText: 'Si, ¡Deseo Borrarlo!'
		}).then((result) => {
		  if (result.value) 
		  {
			  location.href='del_estado.php?id='+id;
		  }
		});
	}
</script>	
