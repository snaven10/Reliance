<?php
				include '../menu/menu.php';
				include '../clases/clase_comicion.php';

				$comicion = new comicion();

				$data = $comicion->get_comicion();
								include '../clases/clase_vendedor.php';
								$vendedor = new vendedor();
								include '../clases/clase_mecanico.php';
								$mecanico = new mecanico();
		?>
					<ol class="breadcrumb">
					  <li><a onclick="contenido('view_producto.php');">Reliance</a></li>
					  <li class="active">comision</li>
					</ol>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h1 class='text-center'>comision</h1>
						</div>
						<div class="panel-body">
							<a href='add_comicion.php' class='btn btn-info'>Nuevo comicion</a><br><br>
							<div class='table-responsive'>
								<table class='table table-striped table-bordered' id='tabla_datos'>
									<thead>
										<tr>
											<td>Nombre</td>
											<td>Comision</td>
											<td>Tipo persona</td>
											<td class='text-center'><b>Opciones</b></td>
										</tr>
									</thead>
									<?php
									foreach ($data as $row) {?>
									<tr>
										<?php if ($row['Tipo_persona']==1) {?>
											<td><?php $vendedor1 = $vendedor->get_id_vendedor($row['Id_vendedor']); echo $vendedor1[0][2] ?></td>
										<?php }elseif ($row['Tipo_persona']==2) {?>
											<td><?php $mecanico1 = $mecanico->get_id_mecanico($row['Id_mecanico']); echo $mecanico1[0][2].$row['Id_mecanico'] ?></td>
										<?php } ?>
										<td><?php echo $row['Comicion'].'%'; ?></td>
										<td><?php if ($row['Tipo_persona']==1) { echo "Vendedor"; } else { echo "Mecanico"; } ?></td>
										<td><a href='add_comicion.php?id=<?php echo $row[0] ?>' class='btn btn-info'>Editar</a>&nbsp;&nbsp;&nbsp;<a href='#' onclick='javascript:borrar(<?php echo $row[0] ?>);' class='btn btn-danger'>Eliminar</a></td>
									</tr>
									<?php }?>
								</table>
							</div>
						</div>
					</div>
<?php
include '../pie/pie.php';
 ?>
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
