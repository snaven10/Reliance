			<?php
				@session_start();
				$n_factura = '';
				$disabled = '';
				if (isset($_SESSION['n_factura'])) {
					if ($_SESSION['n_factura'] != '') {
						$n_factura = $_SESSION['n_factura'];
						$disabled = 'disabled';
					}
				}
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
					  <li class="active">Entradas de producto</li>
					</ol>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h1 class='text-center'>Entradas de producto</h1>
						</div>
						<div class="panel-body">
							<center><a onclick="eliminar_entrada(0,1)" class='btn btn-info'>Reset</a></center><br>
							<div id="entradas">
								<div class="col-xs-6">
									<input type="text" value="<?php echo $n_factura ?>" id="N_factura" class="form-control" placeholder='N de factura' required <?php echo $disabled; ?>><br>
									<input id="Cod" list="Cod_producto" class="form-control" onchange="buscar($(this).val(),3)" placeholder='Cod producto' required>
									<datalist id="Cod_producto">
										<?php
											foreach ($data as $row){ ?>
												<option value="<?php echo $row['Cod_producto'] ?>"></option>
											<?php } ?>
									</datalist><br>
									<input type="number" class="form-control" id="Precio_compra" placeholder="Precio Compra" required><br>
									<input type="number" class="form-control" id="Cantidad" placeholder="Cantidad" required>

								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" id="Proveedor" placeholder="Proveedor" disabled><br>
									<input type="text" class="form-control" id="Nombre_proc" placeholder="Nombre_producto" disabled><br>
									<input type="number" class="form-control" id="Precio_Venta" placeholder="Precio Venta" required><br>
									<input type="number" class="form-control" id="Descuento" placeholder="Descuento" required>
								</div>
							</div>
							<div class="col-xs-12"><br>
								<table class="table table-striped table-bordered">
									<tbody>
										<tr>
											<td>
												<a href="#" class="btn btn-success aEntrada" >Agregar</a>
												<a href="guardar_entradas.php?guardar=1" class="btn btn-primary" style="float: right;">Guardar Entrada</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-xs-12"><br>
								<table class='table table-striped table-bordered' id='tabla_datos'>
									<CENTER><h2>REPORTE DE ENTRADAS <?php echo date('d-m-Y'); ?></h2></CENTER>
									<thead>
										<tr>
											<th>N de Factura</th>
											<th>Cod Producto</th>
											<th>Nombre</th>
											<th>Cantidad</th>
											<th>Precio_C</th>
											<th>Precio_V</th>
											<th>Proveedor</th>
											<th>Opciones</th>
										</tr>
									</thead>
									<tbody class="result" id='mostrar-entradas'>
										<?php 
										if (isset($_SESSION['n'])):
											for ($i=0; $i < $_SESSION['n']; $i++) {
												if ($_SESSION["p"][$i] != null) {
													$r = $_SESSION["p"][$i];
													foreach ($r as $k) {
														if($k[0] != null){?>
															<tr>
																<td><?php echo $k[6]; ?></td>
																<td><?php echo $k[0]; ?></td>
																<td><?php $data = $producto->get_producto_cod($k[0]);  echo $data[0][3] ; ?></td>
																<td><?php echo $k[1]; ?></td>
																<td><?php echo $k[2]; ?></td>
																<td><?php echo $k[3]; ?></td>
																<td><?php echo $k[7]; ?></td>
																<td><a class='btn btn-danger' onclick='eliminar_entrada(<?php echo $i;  ?>,0)' id='eliminar_ss'><span class='glyphicon glyphicon-remove'></span></a></td>
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
		var n_factura = $('#N_factura').val();
		if (n_factura != '') {
			if (dato != '') {
				$("#N_fact").find('.text-danger').remove();
				//console.log(dato);
				$.ajax({
					url: "agregar_pu.php",
					type : 'post',
					dataType: 'html',
					data: {
						n_factura: n_factura,
						dato: dato,
						tipo: tipo,
						Sa: 0
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
		}else{
			$("#Cod").val('');
			$("#N_factura").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#N_factura').closest('.form-group').addClass('has-error');
		}			
	}
</script>
