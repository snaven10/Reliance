<?php session_start();
include '../clases/clase_producto.php';
$producto = new producto();
include '../clases/clase_proveedor.php';
$proveedor = new proveedor();
include '../clases/clase_ubicacion.php';
$ubicacion = new ubicacion();
include '../clases/clase_precio.php';
$precio = new precio();
date_default_timezone_set('UTC');
if (isset($_GET['guardar'])) {
	$numero = $precio->ultimo_trs();
	if ($numero[0][0] == "") {
		$num = 1;
	} elseif ($numero[0][0] > 0) {
		$num = ($numero[0][0] + 1);
	}
	$precio = null;
	$precio = new precio();
	if ($precio->add_trs($num, $_SESSION['Sucursal'], $_SESSION['Id_sucursal']) == 0) {
		$precio = null;
		$precio = new precio();
	} else { ?>
		<script>
			alert('Ocurrio un error!');
			location.href = 'guardar_trs.php';
		</script>
		<?php }
	for ($i = 0; $i < $_SESSION['n-trs']; $i++) {
		if ($_SESSION["trs"][$i] != null) {
			$r = $_SESSION["trs"][$i];
			foreach ($r as $row) {
				$data = $producto->get_producto_cod($row[0]);
				foreach ($data as $key) {
					$cod = $key['Id_producto'];
					$precio->edit_precio_salidas($cod, $row[1]);
					$precio = null;
					$precio = new precio();
					$ultimo_c = $precio->ultimo_trs();
					if ($ultimo_c[0][0] == 0) {
						$ultimo = 1;
					} elseif ($ultimo_c[0][0] > 0) {
						$ultimo = ($ultimo_c[0][0]);
					}
					if ($precio->add_reporte_trs($ultimo, $row[1], $row[2], $cod) == 0) {
						$precio = null;
						$precio = new precio();
					} else { ?>
						<script>
							alert('Ocurrio un error!');
							location.href = 'guardar_trs.php';
						</script>
					<?php }
				}
			}
		}
	}
	$_SESSION['trs'] = null;
	$_SESSION['n-trs'] = 0;
	$_SESSION['Sucursal'] = null;
	echo "<script>location.href='reporte_trs.php?imp=" . $ultimo . "&ubicacion=1';</script>";
}
?>