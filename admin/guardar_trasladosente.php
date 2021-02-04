<?php session_start();
include '../clases/clase_producto.php';
				$producto = new producto();
				$data = $producto->get_producto();
				include '../clases/clase_proveedor.php';
				$proveedor = new proveedor();
				include '../clases/clase_ubicacion.php';
				$ubicacion = new ubicacion();
				include '../clases/clase_precio.php';
				$precio = new precio();
date_default_timezone_set('UTC');
if (isset($_GET['guardar'])) {
	$numero = $precio->ultimo_traslado_entr();
	if ($numero[0][0] == "") {
		$num = 1;
	}elseif ($numero[0][0] > 0) {
		$num = ($numero[0][0]+1);
	}
	$precio = null;
	$precio = new precio();
	if ($precio->add_traslados_entradas($_SESSION['N_traslado'][1],date('Y-m-d'),$num,$_SESSION['N_traslado'][0],1) == 0) {
		$precio = null;
		$precio = new precio();
	}else{ ?>
		<script>alert('Ocurrio un error!');location.href='traslados_e.php';</script>
	<?php }
	for ($i=0; $i < $_SESSION['n_trasentr']; $i++) {
		if ($_SESSION["p_trasentr"][$i] != null) {
			$r = $_SESSION["p_trasentr"][$i];
			foreach ($r as $row) {
				if($row[0] != null){
					$data = $producto->get_producto_cod($row[0]);
					foreach ($data as $key) {
						$cod = $key['Id_producto'];
						$precio->edit_precios($cod,$row[1],$row[2],$row[3],$row[4],1);
						$precio = null;
						$precio = new precio();
						$ultimo_c = $precio->ultimo_traslado_entr();
						if (count($ultimo_c[0][0]) == 0) {
							$ultimo = 1;
						}elseif ($ultimo_c[0][0] > 0) {
							$ultimo = $ultimo_c[0][1];
						}
						if ($precio->add_reporte_entrada_traslados($ultimo,$row[1],$row[2],$row[3],$row[4],$cod) == 0) {
							$precio = null;
							$precio = new precio();
						}else{ ?>
							<script>alert('Ocurrio un error!');location.href='traslados_e.php';</script>
						<?php }
					}
				}
			}
		}
	}
	$_SESSION['p_trasentr'] = null;
	$_SESSION['n_trasentr'] = 0;
	$_SESSION['N_traslado'][0] = '';
	$_SESSION['N_traslado'][1] = '';
	echo "<script>location.href='reporte_entradas_traslados.php?imp=".$ultimo."&ubicacion=1';</script>";
}
?>
