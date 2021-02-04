<?php 
@session_start();
$_SESSION["p"][$_POST['pos']][$_POST['pos']][0] = null;
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
				</div>";
			}	
		}
	} 
}
echo $rp;
?>