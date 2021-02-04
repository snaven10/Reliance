<?php 
@session_start();
$rp = "";
if ($_POST['tipo'] == 1) {
	$_SESSION['p_trasentr'] = null;
	$_SESSION['n_trasentr'] = 0;
	$_SESSION['N_traslado'][0] = '';
	$_SESSION['N_traslado'][1] = '';
}else{
	include '../clases/clase_producto.php';
	$_SESSION["p_trasentr"][$_POST['pos']][$_POST['pos']][0] = null;
	for ($i=0; $i < $_SESSION['n_trasentr']; $i++) {
		if ($_SESSION["p_trasentr"][$i] != null) {
			$r = $_SESSION["p_trasentr"][$i];
			foreach ($r as $k) {
				if($k[0] != null){
					$productos = new producto();
					$data = $productos->get_producto_cod($k[0]);
					$rp = $rp."
					 <tr>
					 	<td>".$k[6]."</td>
					 	<td>".$k[0]."</td>
					 	<td>".$data[0][3]."</td>
					 	<td>".$k[1]."</td>
					 	<td>".$k[2]."</td>
					 	<td>".$k[3]."</td>
					 	<td>".$k[7]."</td>
					 	<td><a class='btn btn-danger' onclick='eliminar_trasladosentr(".$i.",0)' id='eliminar_ss'><span class='glyphicon glyphicon-remove'></span></a></td>
					 </tr>";
				}	
			}
		} 
	}
}
echo $rp;
?>