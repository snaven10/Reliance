<?php
				include '../menu/menu.php';
				include '../clases/clase_factura.php';
				$factura = new factura();
				$data = $factura->get_factura();

		?>
					<ol class="breadcrumb">
					  <li><a onclick="contenido('view_producto.php');">Reliance</a></li>
					  <li class="active">Administrador de facturas</li>
					</ol>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h1 class='text-center'>Administrador de facturas</h1>
						</div>
						<div class="panel-body">
							<div class='table-responsive'>
								<table class='table table-striped table-bordered' id='tabla_datos'>
									<thead>
										<tr>
											<td>Serie</td>
											<td>Numero_factura</td>
											<td>Estado</td>
										</tr>
									</thead>
									<?php
									foreach ($data as $row) {?>
									<tr <?php if ($row['Estado'] == 0) { ?> class="danger" style="cursor: pointer;" <?php }else{
                                                        ?> style="cursor: pointer;"<?php } ?>>
										<td><?php echo $row['Serie'] ?></td>
										<td><?php echo $row['Numero_cor'] ?></td>
										<td><?php if ($row["CCF"]==1) { echo "CCF"; }elseif ($row["CCF"]==0) { echo "FACTURA"; } ?></td>
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
			  location.href='del_factura.php?id='+id;
		  }
		});
	}
</script>	
