<?php
include '../clases/clase_proveedor.php';
include '../clases/clase_ubicacion.php';
include '../clases/clase_producto.php';
include '../clases/clase_precio.php';
include '../clases/clase_mecanico.php';
include '../clases/clase_vendedor.php';
include '../clases/clase_sucursales.php';
	$sucursales = new sucursales();
	$sucursal = $sucursales->mostrar_sucursales();
	$precio = new precio();
	$producto = new producto();
	$data = $producto->get_producto_cod($_POST['dato']);
	foreach ($data as $key) {
		$precios = $precio->get_precio_id_producto($key['Id_producto']);
		foreach ($precios as $row_precios){}
		if ($_POST['Sa'] == 1) { ?>
	<div id="entradas">
		<div class="col-xs-6">
			<b>Cod Producto:</b>
			<input id="Cod-s" value="<?php echo $_POST['dato']; ?>" list="Cod_producto" class="form-control" onchange="buscar($(this).val())" placeholder='Cod producto' required>
			<datalist id="Cod_producto">
				<?php
					$data1 = $producto->get_producto();
					foreach ($data1 as $row){ ?>
						<option value="<?php echo $row['Cod_producto'] ?>"></option>
					<?php } ?>
			</datalist><br>
			<b>Cantidad:</b>
			<input type="number" value="<?php echo $row_precios[1]; ?>" class="form-control" id="Cantidad-s" placeholder="Cantidad" required><br>
			<b>Descripcion:</b>
			<input type="text" class="form-control" id="Descripcion-s" placeholder="Descripcion" required><br>
			<b>Sucursal:</b>
			<select name="Sucursal" id="Sucursal" class="form-control">
				<?php
					foreach ($sucursal as $row){ ?>
						<option value="<?php echo $row['Id_sucursales'] ?>"><?php echo $row['Sucursal'] ?></option>
					<?php } ?>
			</select><br>
		</div>
		<div class="col-xs-6">
			<b>Nombre Producto:</b>
			<input type="text" value="<?php echo $key['Nombre']; ?>" class="form-control" id="Nombre_proc" placeholder="Nombre_producto" disabled><br>
			<b>Precio Compra:</b>
			<input type="number" value="<?php echo $row_precios[2]; ?>" class="form-control" id="Precio_compra" placeholder="Precio Compra" disabled><br>
			<b>Precio Venta:</b>
			<input type="number" value="<?php echo $row_precios[3]; ?>" class="form-control" id="Precio_Venta" placeholder="Precio Venta" disabled><br>
		</div>
	</div>
		<?php }else{ ?>
	<div id="entradas">
		<div class="col-xs-6">
			<b>N de traslado:</b>
			<input type="text" value="<?php echo $_POST['n_traslado'] ?>" class="form-control" id="N_traslado" placeholder="N de traslado" disabled><br>
			<b>Cod Producto:</b>
			<input id="Cod" value="<?php echo $_POST['dato']; ?>" list="Cod_producto" class="form-control" onchange="buscar($(this).val())" placeholder='Cod producto' required>
			<datalist id="Cod_producto">
				<?php
					$data1 = $producto->get_producto();
					foreach ($data1 as $row){ ?>
						<option value="<?php echo $row['Cod_producto'] ?>"></option>
					<?php } ?>
			</datalist><br>
			<b>Precio Compra:</b>
			<input type="number" value="<?php echo $row_precios[2]; ?>" class="form-control" id="Precio_compra" placeholder="Precio Compra" required><br>
			<b>Cantidad:</b>
			<input type="number" value="<?php echo $row_precios[1]; ?>" class="form-control" id="Cantidad" placeholder="Cantidad" required>

		</div>
		<div class="col-xs-6">
			<b>Sucursal:</b>
			<select name="Sucursal" id="Sucursal" class="form-control">
				<?php
					foreach ($sucursal as $row){ ?>
						<option value="<?php echo $row['Id_sucursales'] ?>"><?php echo $row['Sucursal'] ?></option>
					<?php } ?>
			</select><br>
			<b>Nombre Producto:</b>
			<input type="text" value="<?php echo $key['Nombre']; ?>" class="form-control" id="Nombre_proc" placeholder="Nombre_producto" disabled><br>
			<b>Precio Venta:</b>
			<input type="number" value="<?php echo $row_precios[3]; ?>" class="form-control" id="Precio_Venta" placeholder="Precio Venta" required><br>
			<b>Descuento:</b>
			<input type="number" value="<?php echo $row_precios[4]; ?>" class="form-control" id="Descuento" placeholder="Descuento" required>
			<input type="hidden" value="<?php echo $key['Nombre']; ?>" class="form-control" id="Nombre_proc" placeholder="Nombre_producto">
		</div>
	</div>	
		<?php } 
	}
 ?>
