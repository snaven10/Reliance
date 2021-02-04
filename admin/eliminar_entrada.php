<?php 
@session_start();
$rp = "";
if ($_POST['tipo'] == 1) {
	$_SESSION['p'] = null;
	$_SESSION['n'] = 0;
	$_SESSION['n_factura'] = '';
}else{
	include '../clases/clase_producto.php';
	$_SESSION["p"][$_POST['pos']][$_POST['pos']][0] = null;
	for ($i=0; $i < $_SESSION['n']; $i++) {
		if ($_SESSION["p"][$i] != null) {
			$r = $_SESSION["p"][$i];
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
					 	<td>".$k[3]."</td>
					 	<td><a class='btn btn-danger' onclick='eliminar_entrada(".$i.",0)' id='eliminar_ss'><span class='glyphicon glyphicon-remove'></span></a></td>
					 </tr";
				}	
			}
		} 
	}
}
echo $rp;
?>