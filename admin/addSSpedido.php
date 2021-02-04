<?php
	@session_start();
	if (isset($_POST['Dato']) && isset($_POST['Tipo']) && isset($_POST['Pos'])) {
		echo $_POST['Dato'];
		echo $_POST['Pos'];
		if ($_POST['Tipo']==1) {
			$_SESSION["p"][$_POST['Pos']][$_POST['Pos']][1] = $_POST['Dato'];
		}elseif ($_POST['Tipo']==2) {
			$_SESSION["p"][$_POST['Pos']][$_POST['Pos']][2] = $_POST['Dato'];
		}
	}
	if (empty($_SESSION['n'])) {
		$_SESSION['n'] = 0;
	}
	if (!empty($_POST['id'])) {
		$pos = 0;
		$val = 0;
		if($_SESSION['n']==0){
			if (!empty($_SESSION["p"])) {
				if($_SESSION["p"][0][0][0] == $_POST['id']){
					$_SESSION["p"][0][0][1] += $_POST['can'];
					echo view_ss();
				}
			}
		}elseif($_SESSION['n']>0){
			for ($i=0; $i < $_SESSION['n']; $i++) {
				if ($_SESSION["p"][$i] != null) {
					$r = $_SESSION["p"][$i];
					foreach ($r as $k) {
						if($k[0] == $_POST['id']){
							$_SESSION["p"][$i][$i][1] += $_POST['can'];
							$val = 1;
							echo view_ss();
						}
					}
				}
			}
		}
		if($val==0){
			$i = $_SESSION['n'];
			$pedido[$i][0] = $_POST['id'];
			$pedido[$i][1] = $_POST['can'];
			$pedido[$i][2] = $_POST['pre'];
			$pedido[$i][3] = $_POST['cod'];
			$pedido[$i][4] = $_POST['nom'];
			$pedido[$i][5] = $_POST['pre_c'];
			$_SESSION["p"][$i] = $pedido;
			$i++;
			$_SESSION['n'] = $i;
			echo view_ss();
		}
	}

	if (!empty($_POST['key'])) {
		echo view_ss();
	}
	function view_ss(){
		$rp = "";
		for ($i=0; $i < $_SESSION['n']; $i++) {
			if ($_SESSION["p"][$i] != null) {
				$r = $_SESSION["p"][$i];
				foreach ($r as $k) {
					if($k[0] != null){
						$rp = $rp."
						<div class='list-group-item'>
							<div class='row'>
								<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'>
									".$k[3]."
								</div>
								<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'>
									".$k[4]."
								</div>
								<div class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>
									<input type='number' name='cantidad' id='cantidad' onchange='agregar_p($(this).val(),".$i.",1)' value='".$k[1]."' class='form-control' min='0'>
								</div>
								<div class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>
									<input type='number' name='precio' id='precio' onchange='agregar_p($(this).val(),".$i.",2)' value='".$k[2]."' class='form-control' min='0'>
								</div>
								<div class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>
									<a class='btn btn-danger' onclick='eliminar_ss(".$i.")' id='eliminar_ss'><span class='glyphicon glyphicon-remove'></span></a>
								</div>
								
							</div>
						</div>
						";
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
