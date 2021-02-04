<?php
				include '../menu/menu.php';
				/*if (!isset($_POST['validacion'])) {
					if (basename($_SERVER["PHP_SELF"]) != 'index.php') {
						header('location: ../admin');
					}
				}*/
				include '../clases/clase_ubicacion.php';

				$ubicacion = new ubicacion();

				$data = $ubicacion->get_ubicacion();
				
		?>
					<ol class="breadcrumb">
					  <li><a onclick="contenido('view_producto.php');">Reliance</a></li>
					  <li class="active">ubicacion</li>
					</ol>
					<div class="panel panel-primary"> 
						<div class="panel-heading"> 
							<h1 class='text-center'>ubicacion</h1>
						</div> 
						<div class="panel-body"> 
							<a href='add_ubicacion.php' class='btn btn-info'>Nuevo ubicacion</a><br><br>
							<div class='table-responsive'>
								<table class='table table-striped table-bordered' id='tabla_datos'>
									<thead>
										<tr> 
											<td>Id_ubicacion</td>
											<td>Estante</td>
											<td>Estado</td>  
											<td class='text-center'><b>Opciones</b></td>
										</tr>
									</thead>
									<?php
									foreach ($data as $row) {?>
									<tr> 
										<td><?php echo $row['Id_ubicacion'] ?></td>
										<td><?php echo $row['Estante'] ?></td>
										<td><?php echo $row['Estado'] ?></td>
										<td><a href='add_ubicacion.php?id=<?php echo $row[0] ?>' class='btn btn-info'>Editar</a>&nbsp;&nbsp;&nbsp;<a href='#' onclick='javascript:borrar(<?php echo $row[0] ?>);' class='btn btn-danger'>Eliminar</a></td>				
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
