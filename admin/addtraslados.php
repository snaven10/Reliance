<?php 
	include '../clases/clase_producto.php';
	include '../clases/clase_sucursales.php';
	$sucursales = new sucursales();
	@session_start();
	if (empty($_SESSION['n_trasentr'])) {
		$_SESSION['n_trasentr'] = 0;
	}
	if (!empty($_POST['cod'])) {
		$pos = 0;
		$val = 0;
		if($_SESSION['n_trasentr']==0){
			if (!empty($_SESSION["p_trasentr"])) {
				if($_SESSION["p_trasentr"][0][0][0] == $_POST['cod']){
					$_SESSION["p_trasentr"][0][0][1] += $_POST['can'];
					echo view_ss(); 
				}	
			}
		}elseif($_SESSION['n_trasentr']>0){
			for ($i=0; $i < $_SESSION['n_trasentr']; $i++) {
				if ($_SESSION["p_trasentr"][$i] != null) {
					$r = $_SESSION["p_trasentr"][$i];
					foreach ($r as $k) {
						if($k[0] == $_POST['cod']){
							$_SESSION["p_trasentr"][$i][$i][1] += $_POST['can'];
							$val = 1;
							echo view_ss(); 
						}	
					}
				}
			}
		}
		if($val==0){
			$sucursal = $sucursales->get_id_sucursales($_POST['sucursal']);
			$_SESSION['N_traslado'][0] = $_POST['n_traslados'];
			$_SESSION['N_traslado'][1] = $sucursal['Id_sucursales'];
			$i = $_SESSION['n_trasentr'];
			$pedido[$i][0] = $_POST['cod'];
			$pedido[$i][1] = $_POST['can'];
			$pedido[$i][2] = $_POST['pre_c'];
			$pedido[$i][3] = $_POST['pre_v'];			
			$pedido[$i][4] = $_POST['des'];
			$pedido[$i][5] = $_POST['nom'];
			$pedido[$i][6] = $_POST['n_traslados'];
			$pedido[$i][7] = $sucursal['Sucursal'];
			$_SESSION["p_trasentr"][$i] = $pedido;
			$i++;
			$_SESSION['n_trasentr'] = $i;
			echo view_ss();
		}
	}
	
	if (!empty($_POST['key'])) {
		echo view_ss();
	}
	function view_ss(){
		$rp = "";
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
		return $rp;
	}
		
	

	if (!empty($_GET['del'])) {
		session_unset();
	}
 ?>