<?php
if(isset($_POST['up'])){
	if (!empty($_POST['Cod_producto']) &&!empty($_POST['Nombre']) &&!empty($_POST['Descripcion']) &&!empty($_POST['Id_proveedor']) &&!empty($_POST['Id_ubicacion'])) {
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
					if($tmp == ''){
						$_FILESimg = $_POST['Ima1'];
					}
			include '../clases/clase_producto.php';
			$producto = new producto();
			$data = $producto->get_id_producto($_POST['Id_producto']);
			$producto = null;
			$producto = new producto();
		if ($producto->edit_producto($_POST['Id_producto'],$_POST['Cod_producto'],$_POST['Cod_oem'],$_POST['Nombre'],$_POST['Descripcion'],$_FILESimg,$_POST['Id_proveedor'],$_POST['Id_ubicacion'],1) == 0) {
			include '../clases/clase_precio.php';
			$precio = new precio();
			if ($precio->edit_precio($_POST['Id_precio'],$_POST['Cantidad'],$_POST['Precio'],1) == 0) {
				include '../clases/clase_cod_reemplazo.php';
				$cod_reemplazo = new cod_reemplazo();
				if ($cod_reemplazo->edit_cod_reemplazo_pr($_POST['Id_cod_reemplazo'],$_POST['Cod_Remplazo']) == 0) {
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"></button><strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Se agrego con exito </div>';
				}else{
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button><strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Ocurrio un error! </div>';
				}
			}else{
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button><strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Ocurrio un error! </div>';
			}
		}else{
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button><strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Ocurrio un error! </div>';
		}
		}else{
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Ocurrio un error! </div>';
		}
}
?>
