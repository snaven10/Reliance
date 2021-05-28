<?php
@session_start();
include '../clases/clase_proveedor.php';
include '../clases/clase_ubicacion.php';
include '../clases/clase_producto.php';
include '../clases/clase_precio.php';
include '../clases/clase_mecanico.php';
include '../clases/clase_vendedor.php';
if ($_POST['tipo'] == 1) {
	$proveedor = new proveedor();
	$data_proveedor = $proveedor->buscar_proveedor($_POST['dato']);
	foreach ($data_proveedor as $key) {
		echo $key['Id_proveedor'];
	}
} elseif ($_POST['tipo'] == 2) {
	$E_R_C = $_POST['dato'];
	$ubicacion = new ubicacion();
	$data_ubicacion = $ubicacion->buscar($E_R_C);
	foreach ($data_ubicacion as $key) {
		echo $key['Id_ubicacion'];
	}
} elseif ($_POST['tipo'] == 3) {
	$precio = new precio();
	$producto = new producto();
	$data = $producto->get_producto_cod($_POST['dato']);
	foreach ($data as $key) {
		$precios = $precio->get_precio_id_producto($key['Id_producto']);
		foreach ($precios as $row_precios) {
		}
		if ($_POST['Sa'] == 1) { ?>
			<div id="entradas">
				<div class="col-xs-6">
					<b>Cod Producto:</b>
					<input id="Cod-s" value="<?php echo $_POST['dato']; ?>" list="Cod_producto" class="form-control" onchange="buscar($(this).val(),3)" placeholder='Cod producto' required>
					<datalist id="Cod_producto">
						<?php
						$data1 = $producto->get_producto($_SESSION['Id_sucursal']);
						foreach ($data1 as $row) { ?>
							<option value="<?php echo $row['Cod_producto'] ?>"></option>
						<?php } ?>
					</datalist><br>
					<b>Cantidad:</b>
					<input type="text" value="<?php echo $row_precios[1]; ?>" class="form-control" id="Cantidad-s" placeholder="Cantidad" pattern="^\d*(\.\d{1})?\d{0,1}$" required><br>
					<b>Descripcion:</b>
					<input type="text" class="form-control" id="Descripcion-s" placeholder="Descripcion" required>

				</div>
				<div class="col-xs-6">
					<b>Proveedor:</b>
					<input type="text" value="<?php echo $key['Proveedor']; ?>" class="form-control" id="Proveedor" placeholder="Proveedor" required><br>
					<b>Nombre Producto:</b>
					<input type="text" value="<?php echo $key['Nombre']; ?>" class="form-control" id="Nombre_proc" placeholder="Nombre_producto" disabled><br>
					<b>Precio Compra:</b>
					<input type="number" value="<?php echo $row_precios[2]; ?>" class="form-control" id="Precio_compra" placeholder="Precio Compra" disabled><br>
					<b>Precio Venta:</b>
					<input type="number" value="<?php echo $row_precios[3]; ?>" class="form-control" id="Precio_Venta" placeholder="Precio Venta" disabled><br>
				</div>
			</div>
		<?php } else { ?>
			<div id="entradas">
				<div class="col-xs-6">
					<b>N de Factura:</b>
					<input type="text" value="<?php echo $_POST['n_factura'] ?>" class="form-control" id="N_factura" placeholder="N de factura" disabled><br>
					<b>Cod Producto:</b>
					<input id="Cod" value="<?php echo $_POST['dato']; ?>" list="Cod_producto" class="form-control" onchange="buscar($(this).val(),3)" placeholder='Cod producto' required>
					<datalist id="Cod_producto">
						<?php
						if ($_SESSION['Tipo']) {
							$data1 = $producto->get_producto_list();
						} else {
							$data1 = $producto->get_producto($_SESSION['Id_sucursal']);
						}
						foreach ($data1 as $row) { ?>
							<option value="<?php echo $row['Cod_producto'] ?>"></option>
						<?php } ?>
					</datalist><br>
					<b>Precio Compra:</b>
					<input type="text" onkeypress="return filterFloat(event,this);" value="<?php echo $row_precios[2]; ?>" class="form-control" id="Precio_compra" placeholder="Precio Compra" required><br>
					<b>Cantidad:</b>
					<input type="text" onkeypress="return filterFloat(event,this,1);" value="0" class="form-control" id="Cantidad" placeholder="Cantidad" pattern="^\d*(\.\d{1})?\d{0,1}$" required>

				</div>
				<div class="col-xs-6">
					<b>Proveedor:</b>
					<input type="text" value="<?php echo $key['Proveedor']; ?>" class="form-control" id="Proveedor" placeholder="Proveedor" required><br>
					<b>Nombre Producto:</b>
					<input type="text" value="<?php echo $key['Nombre']; ?>" class="form-control" id="Nombre_proc" placeholder="Nombre_producto" disabled><br>
					<b>Precio Venta:</b>
					<input type="text" onkeypress="return filterFloat(event,this);" value="<?php echo $row_precios[3]; ?>" class="form-control" id="Precio_Venta" placeholder="Precio Venta" required><br>
					<b>Descuento:</b>
					<input type="text" onkeypress="return filterFloat(event,this,1);" value="<?php echo $row_precios[4]; ?>" class="form-control" id="Descuento" placeholder="Descuento" required>
					<input type="hidden" value="<?php echo $key['Nombre']; ?>" class="form-control" id="Nombre_proc" placeholder="Nombre_producto">
				</div>
			</div>
<?php }
	}
} elseif ($_POST['tipo'] == 4) {
	$vendedor = new vendedor();
	$data_vendedor = $vendedor->buscar_vendedor($_POST['dato']);
	foreach ($data_vendedor as $key) {
		echo $key['Id_vendedor'];
	}
} elseif ($_POST['tipo'] == 5) {
	$mecanico = new mecanico();
	$data_mecanico = $mecanico->buscar_mecanicos($_POST['dato']);
	foreach ($data_mecanico as $key) {
		echo $key['Id_mecanico'];
	}
}
?>