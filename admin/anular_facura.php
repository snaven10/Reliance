<?php 
include '../clases/clase_encabezado_factura.php';
include '../clases/clase_factura.php';
$encabezado_factura = new encabezado_factura();
if ($_POST['tipo'] == 1) {
	if ($_POST['dato'] == 0) {
		$datos = $encabezado_factura->buscar_fac_ccf(-1,0); ?>
		<input list="factura" class="form-control" id="N_fac" placeholder='SERIE-N FACTURA'>
		<datalist id="factura">
			<?php
				foreach ($datos as $row){ ?>
					<option value="<?php echo $row['Serie'].'-'.$row['N_fac'] ?>"></option>
				<?php } ?>
		</datalist><br>
		<input type="hidden" name="dato_tipo" id="dato_tipo" value="<?php echo $_POST['dato']; ?>">
		<input type="hidden" name="Id_factura" id="Id_factura" value="<?php echo $datos[0][0]; ?>">
		<input type="text" class="form-control" name="Descripcion" id="Descripcion" placeholder="Descripcion">
	<?php }elseif ($_POST['dato'] == 1) {
		$datos = $encabezado_factura->buscar_fac_ccf(0,-1); ?>
		<input list="factura" class="form-control" id="N_fac" placeholder='SERIE-N CCF'>
		<datalist id="factura">
			<?php
				foreach ($datos as $row){ ?>
					<option value="<?php echo $row['Serie'].'-'.$row['N_ccf'] ?>"></option>
				<?php } ?>
		</datalist><br>
		<input type="hidden" name="dato_tipo" id="dato_tipo" value="<?php echo $_POST['dato']; ?>">
		<input type="hidden" name="Id_factura" id="Id_factura" value="<?php echo $datos[0][0]; ?>">
		<input type="text" class="form-control" name="Descripcion" id="Descripcion" placeholder="Descripcion">
	<?php }
}elseif ($_POST['tipo'] == 2) {
	$serie = explode('-', $_POST['N_fac']);
	if ($_POST['dato'] == 0) {
		$ID = $encabezado_factura->buscar_Id_fac_ccf($serie[0],$serie[1],0);	
	}elseif ($_POST['dato'] == 1) {
		$ID = $encabezado_factura->buscar_Id_fac_ccf($serie[0],0,$serie[1]);	
	}
	/*print_r($ID);*/
	if ($encabezado_factura->anular_factura($ID[0][0],0) == 0) { 
		$encabezado_factura = null;
		$encabezado_factura = new encabezado_factura();
		$data = $encabezado_factura->buscar_detalle_venta($ID[0][1]);
		foreach ($data as $row) {
			$valor = $encabezado_factura->get_precio_id_producto($row['Id_producto']);
			if ($encabezado_factura->edit_precio_anu_fac($valor[0][0],$row['Cantidad']) == 0) {
				$encabezado_factura = null;
				$encabezado_factura = new encabezado_factura();
			}else{ ?>
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong><i class="glyphicon glyphicon-ok-sign"></i></strong>
					Ocurrio un error! 
				</div>

			<?php }				
		} 
		if ($encabezado_factura->add_comentario_anular($_POST['Descripcion'],$ID[0][0],1) == 0) {?>
		<?php }else{ ?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong><i class="glyphicon glyphicon-ok-sign"></i></strong>
				Ocurrio un error! 
			</div>

		<?php }	
		?>
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