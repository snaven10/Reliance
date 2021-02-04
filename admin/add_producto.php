<?php
				include '../menu/menu.php';
				include '../clases/clase_proveedor.php';
				include '../clases/clase_ubicacion.php';
				$proveedor = new proveedor();
				$data_proveedor = $proveedor->get_proveedor();
				$ubicacion = new ubicacion();
				$data_ubicacion = $ubicacion->get_ubicacion();
				if (!empty($_GET['id'])) {
					include '../clases/clase_producto.php';
					$producto = new producto();
					$data = $producto->get_id_producto($_GET['id']);
							$nvl = 0;
							foreach ($data as $row){
								$nvl += 1;
							}
				}
?>
			<form id="producto" method='POST' role='form' action="" class='col-xs-12 col-sm-12' enctype='multipart/form-data'>
				<legend>producto</legend>
					<div class='col-xs-6'>
						<input type='text' name='Cod_producto' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[1];}else{if(!empty($_POST['Cod_producto'])){echo $_POST['Cod_producto'];}}?>' placeholder='Cod_producto' required><br>
						<input type='text' name='Cod_oem' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[2];}else{if(!empty($_POST['Cod_oem'])){echo $_POST['Cod_oem'];}}?>' placeholder='Cod_oem' required><br>
						<input type='text' name='Cod_reemplazo' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[1];}else{if(!empty($_POST['Cod_reemplazo'])){echo $_POST['Cod_reemplazo'];}}?>' placeholder='Cod_reemplazo' required><br>
						<input type='text' name='Nombre' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[4];}else{if(!empty($_POST['Nombre'])){echo $_POST['Nombre'];}}?>' placeholder='Nombre' required><br>
						<input type='number' step="any" name='Precio_compra' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[1];}else{if(!empty($_POST['Precio_compra'])){echo $_POST['Precio_compra'];}}?>' placeholder='Precio_compra'><br>
						<input type='number' step="any" name='Precio_venta' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[2];}else{if(!empty($_POST['Precio_venta'])){echo $_POST['Precio_venta'];}}?>' placeholder='Precio_venta'><br>
					</div>
					<div class='col-xs-6'>
						<input type='number' step="any" name='Descuento' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[3];}else{if(!empty($_POST['Descuento'])){echo $_POST['Descuento'];}}?>' placeholder='Descuento'><br>
						<input type='text' name='Descripcion' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[5];}else{if(!empty($_POST['Descripcion'])){echo $_POST['Descripcion'];}}?>' placeholder='Descripcion' required><br>
						<input id="input-3a" type='file' class="file" name='Ima' value='<?php if(!empty($_GET['id'])){echo $row[6];}else{if(!empty($_POST['img'])){echo $_POST['img'];}}?>' placeholder='img'><br>
						<input list="b_proveedor" class="form-control" onchange="buscar($(this).val(),1)" placeholder='proveedor'>
						<datalist id="b_proveedor">
							<?php
								foreach ($data_proveedor as $row){ ?>
									<option value="<?php echo $row['Nombre'] ?>"></option>
								<?php } ?>
						</datalist><br>
						<input type="hidden" name="Id_proveedor" id="Id_proveedor">

						<input list="b_ubicacion" class="form-control" onchange="buscar($(this).val(),2)" placeholder='ubicacion' id="ubicacion">
						<datalist id="b_ubicacion">
							<?php
								foreach ($data_ubicacion as $row){ ?>
									<option value="<?php echo $row['Estante'];  ?>"></option>
								<?php } ?>
						</datalist><br>  
						<input type="hidden" name="Id_ubicacion" id="Id_ubicacion">
						<input type="hidden" name="add">
					</div>
					<div class='col-xs-12'>
						<button type='submit' name='add' class='btn btn-success'>Guardar</button>
					</div>
			</form>
<?php
include '../pie/pie.php';
if (isset($_POST['add']))
{
	if (!empty($_GET['id']))
	{
		if (!empty($_POST['Cod_producto']) &&!empty($_POST['Cod_oem']) &&!empty($_POST['Cantidad']) &&!empty($_POST['Nombre']) &&!empty($_POST['Descripcion']) &&!empty($_POST['Ima']) &&!empty($_POST['Id_proveedor']) &&!empty($_POST['Id_ubicacion'])) {
			date_default_timezone_set('America/El_salvador');
					$fecha= date('ymdhis');
					$_FILESimg ='img_'.$fecha;
					$tipo=$_FILES['Ima']['type'];
					$tmp=$_FILES['Ima']['tmp_name'];
					$ext=substr($tipo,6,20);
					$_FILESimg=$_FILESimg.'.'.$ext;
					if($tipo=='image/jpeg' || $tipo=='image/jpg' ||
				        $tipo=='image/png' ||$tipo=='image/gif'){
				    copy($tmp,'../img/'.$_FILESimg);
				    unlink('../img/'.$_GET['Ima']);
				}
		if ($producto->edit_producto($_GET['id'],$_POST['Cod_producto'],$_POST['Cod_oem'],$_POST['Cantidad'],$_POST['Nombre'],$_POST['Descripcion'],$_FILESimg,$_POST['Id_proveedor'],$_POST['Id_ubicacion'],1) == 0) { ?>

			<script>alert('Se ha editado un registro con exito');location.href='view_producto.php';</script>
		<?php
		}else{ ?>
			<script>alert('Ocurrio un error!');location.href='view_producto.php';</script>
		<?php }
		}
	}else{
	if (!empty($_POST['Cod_producto']) && !empty($_FILES['Ima']) && !empty($_POST['Cod_oem']) &&!empty($_POST['Nombre']) &&!empty($_POST['Descripcion']) &&!empty($_POST['Id_proveedor']) &&!empty($_POST['Id_ubicacion'])) {
		date_default_timezone_set('America/El_salvador');
					$fecha= date('ymdhis');
					$_FILESimg ='img_'.$fecha;
					$tipo=$_FILES['Ima']['type'];
					$tmp=$_FILES['Ima']['tmp_name'];
					$ext=substr($tipo,6,20);
					$_FILESimg=$_FILESimg.'.'.$ext;
					if($tipo=='image/jpeg' || $tipo=='image/jpg' ||
				        $tipo=='image/png' ||$tipo=='image/gif'){
				    copy($tmp,'../img/'.$_FILESimg);
				    @unlink('../img/'.$_GET['img']);
				}
		include '../clases/clase_producto.php';
		$producto = new producto();
		if ($producto->add_producto($_POST['Cod_producto'],$_POST['Cod_oem'],$_POST['Nombre'],$_POST['Descripcion'],$_FILESimg,$_POST['Id_proveedor'],$_POST['Id_ubicacion'],1) == 0) {
			if(!empty($_POST['Precio_compra'])){
				$Precio_compra= $_POST['Precio_compra'];
			}else{
				$Precio_compra = 0;
			}
			if(!empty($_POST['Precio_venta'])){
				$Precio_venta= $_POST['Precio_venta'];
			}else{
				$Precio_venta = 0;
			}
			if(!empty($_POST['Descuento'])){
				$Descuento= $_POST['Descuento'];
			}else{
				$Descuento = 0;
			}
			$producto1 = new producto();
			$ultimo = $producto1->ultimo();
			include '../clases/clase_precio.php';
			$precio = new precio();
			$precio->add_precio(0,$Precio_compra,$Precio_venta,$Descuento,$ultimo[0][0],1);

			include '../clases/clase_cod_reemplazo.php';
			$cod_reemplazo = new cod_reemplazo();
			$cod_reemplazo->add_cod_reemplazo($_POST['Cod_reemplazo'],$ultimo[0][0],1);
			?>

		<script>alert('Se agrego con exito');location.href='view_producto.php';</script>

		<?php }else{ ?>
			<script>alert('Ocurrio un error!');location.href='view_producto.php';</script>

		<?php }

	}
	}
}
?>
<script>
	function buscar(dato,tipo){
		if (dato != '') {
			//alert(dato+' Tipo: '+tipo);
			$('#img').html("<img src='../img/cargando.gif' width=30 height=30/>");
			console.log(dato);
			$.ajax({
				url: "agregar_pu.php",
				type : 'post',
				dataType: 'html',
				data: {
					dato: dato,
					tipo: tipo
				},
			})
			.done(function(data) {
				if (tipo == 1) {
					$('#Id_proveedor').val(data);
					console.log(data);
				}else if(tipo == 2){
					if (data > 0) {
						$('#Id_ubicacion').val(data);
					}else{
						$('#ubicacion').val('');
					}					
				}
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
