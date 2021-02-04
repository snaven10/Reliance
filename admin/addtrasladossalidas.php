<?php 
	include '../clases/clase_producto.php';
	@session_start();
	if (empty($_SESSION['n-trs'])) {
		$_SESSION['n-trs'] = 0;
	}
	if (!empty($_POST['cod'])) {
		$pos = 0;
		$val = 0;
		if($_SESSION['n-trs']==0){
			if (!empty($_SESSION["trs"])) {
				if($_SESSION["trs"][0][0][0] == $_POST['cod']){
					$_SESSION["trs"][0][0][1] += $_POST['can'];
					echo view_ss(); 
				}	
			}
		}elseif($_SESSION['n-trs']>0){
			for ($i=0; $i < $_SESSION['n-trs']; $i++) {
				if ($_SESSION["trs"][$i] != null) {
					$r = $_SESSION["trs"][$i];
					foreach ($r as $k) {
						if($k[0] == $_POST['cod']){
							$_SESSION["trs"][$i][$i][1] += $_POST['can'];
							$val = 1;
							echo view_ss(); 
						}	
					}
				}
			}
		}
		if($val==0){
			$_SESSION['Sucursal'] = $_POST['sucursal'];
			$i = $_SESSION['n-trs'];
			$pedido[$i][0] = $_POST['cod'];
			$pedido[$i][1] = $_POST['can'];			
			$pedido[$i][2] = $_POST['des'];
			$_SESSION["trs"][$i] = $pedido;
			$i++;
			$_SESSION['n-trs'] = $i;
			echo view_ss();
		}
	}
	
	if (!empty($_POST['key'])) {
		echo view_ss();
	}
	function view_ss(){
		$rp = ""; 
		for ($i=0; $i < $_SESSION['n-trs']; $i++) {
			if ($_SESSION["trs"][$i] != null) {
				$r = $_SESSION["trs"][$i];
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
							<td><a class='btn btn-danger' onclick='eliminar_trs(".$i.")' id='eliminar_ss'><span class='glyphicon glyphicon-remove'></span></a></td>
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