<?php 
@session_start();
include '../clases/clase_producto.php';
$_SESSION["s"][$_POST['pos']][$_POST['pos']][0] = null;
$rp = "";
for ($i=0; $i < $_SESSION['n-s']; $i++) {
	if ($_SESSION["s"][$i] != null) {
		$r = $_SESSION["s"][$i];
		foreach ($r as $k) {
			if($k[0] != null){
				$productos = new producto();
				$data = $productos->get_producto_cod($k[0]);
				$rp = $rp."
				<tr>
					<td>".$k[0]."</td>
					<td>".$data[0][3]."</td>
					<td>".$k[1]."</td>
					<td>".$k[2]."</td>
					<td><a class='btn btn-danger' onclick='eliminar_salida(".$i.")' id='eliminar_ss'><span class='glyphicon glyphicon-remove'></span></a></td>
				</tr>";
			}	
		}
	} 
}
echo $rp;
?>