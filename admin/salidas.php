			<?php
			@session_start();
				include '../menu/menu.php';
				include '../clases/clase_producto.php';
				$producto = new producto();

				$data = $producto->get_producto();
				include '../clases/clase_proveedor.php';
				$proveedor = new proveedor();
				include '../clases/clase_ubicacion.php';
				$ubicacion = new ubicacion();
		?>
					<ol class="breadcrumb">
					  <li><a  href="../admin/" style="cursor: pointer;">Reliance</a></li>
					  <li class="active">Salidas de producto</li>
					</ol>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h1 class='text-center'>Salidas de producto</h1>
						</div>
						<div class="panel-body">
							<div id="entradas">
								<div class="col-xs-6">
									<b>Cod Producto:</b>
									<input id="Cod-s" list="Cod_producto" class="form-control" onchange="buscar($(this).val(),3)" placeholder='Cod producto' required>
									<datalist id="Cod_producto">
										<?php
											foreach ($data as $row){ ?>
												<option value="<?php echo $row['Cod_producto'] ?>"></option>
											<?php } ?>
									</datalist><br>
									<b>Cantidad:</b>
									<input type="number" class="form-control" id="Cantidad-s" placeholder="Cantidad" required><br>
									<b>Descripcion:</b>
									<input type="text" class="form-control" id="Descripcion-s" placeholder="Descripcion" required>
								</div>
								<div class="col-xs-6">
									<b>Nombre Producto:</b>
									<input type="text" class="form-control" id="Nombre_proc" placeholder="Nombre_producto" disabled><br>
									<b>Precio Compra:</b>
									<input type="number" class="form-control" id="Precio_compra" placeholder="Precio Compra" disabled><br>
									<b>Precio Venta:</b>
									<input type="number" class="form-control" id="Precio_Venta" placeholder="Precio Venta" disabled><br>
								</div>
							</div>
							<div class="col-xs-12">
								<table class="table table-striped table-bordered">
									<tbody>
										<tr>
											<td>
												<a href="#" class="btn btn-success aSalida" >Agregar</a>
												<a href="guardar_salidas.php?guardar=1" class="btn btn-primary" style="float: right;">Guardar Salidas</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-xs-12"><br>
								<table class='table table-striped table-bordered' id='tabla_datos'>
									<CENTER><h2>REPORTE DE SALIDAS <?php echo date('d-m-Y'); ?></h2></CENTER>
									<thead>
										<tr>
											<th>Cod Producto</th>
											<th>Nombre</th>
											<th>Cantidad</th>
											<th>Descripcion</th>
											<th>Opciones</th>
										</tr>
									</thead>
									<tbody class="result" id='mostrar-salidas'>
										<?php 
										if (isset($_SESSION['n-s'])):
											for ($i=0; $i < $_SESSION['n-s']; $i++) {
												if ($_SESSION["s"][$i] != null) {
													$r = $_SESSION["s"][$i];
													foreach ($r as $k) {
														if($k[0] != null){?>
															<tr>
																<td><?php echo $k[0]; ?></td>
																<td><?php $data = $producto->get_producto_cod($k[0]);  echo $data[0][3] ; ?></td>
																<td><?php echo $k[1]; ?></td>
																<td><?php echo $k[2]; ?></td>
																<td><a class='btn btn-danger' onclick='eliminar_salida(<?php echo $i;  ?>)' id='eliminar_ss'><span class='glyphicon glyphicon-remove'></span></a></td>
															</tr>
														<?php }	
													}
												} 
											} 
											endif 
										?>
									</tbody>
								</table>																
							</div>
						</div>
					</div>
<?php include '../pie/pie.php'; ?>
<script>
	function buscar(dato,tipo){
		if (dato != '') {
			console.log(dato);
			$.ajax({
				url: "agregar_pu.php",
				type : 'post',
				dataType: 'html',
				data: {
					dato: dato,
					tipo: tipo,
					Sa: 1
				},
			})
			.done(function(data) {
				document.getElementById('entradas').innerHTML = data;
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				$('#img').html("");
			});
        }
	}
</script>
