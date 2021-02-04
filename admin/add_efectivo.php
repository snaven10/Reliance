<?php 
date_default_timezone_set('America/El_salvador');
include '../clases/clase_cierre.php';
$cierre = new cierre();
if ($_POST['tipo']==1) {
	if ($cierre->add_deposito($_POST['saldo_deposito'],date('Y-m-d H:i:s')) == 0) { ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> 
			Se agrego con exito 
		</div>
	<?php }else{ ?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong><i class="glyphicon glyphicon-ok-sign"></i></strong>
			Ocurrio un error! 
		</div>
	<?php }	
} elseif ($_POST['tipo']==2) {	
	if ($cierre->add_gasto($_POST['Monto'],$_POST['Descripcion']) == 0) { ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> 
			Se agrego con exito 
		</div>
	<?php }else{ ?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong><i class="glyphicon glyphicon-ok-sign"></i></strong>
			Ocurrio un error! 
		</div>
	<?php }	
} elseif ($_POST['tipo']==3) {	
	if ($cierre->add_egresos($_POST['Monto'],$_POST['Descripcion']) == 0) { ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> 
			Se agrego con exito 
		</div>
	<?php }else{ ?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong><i class="glyphicon glyphicon-ok-sign"></i></strong>
			Ocurrio un error! 
		</div>
	<?php }	
} 
?>
