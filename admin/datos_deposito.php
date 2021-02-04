<?php 
date_default_timezone_set('America/El_salvador');
	include '../clases/clase_cierre.php';
	$cierre = new cierre();
	$ultimo_cierre = $cierre->get_ultimo_cierre_general();
	$fecha = $ultimo_cierre['Fecha'];
	$nuevafecha = strtotime('+1 day', strtotime($fecha));
	$nuevafecha = date('Y-m-d',$nuevafecha);
	$cerrado = $cierre->get_cierre($nuevafecha,date('Y-m-d'));
	if ($cerrado['Total'] == 0) {
		$venta = $cierre->get_venta_total($nuevafecha,date('Y-m-d'));
		$gastos = $cierre->get_gastos($nuevafecha.' 05:00:00',date('Y-m-d H:i:s'));
		$egresos = $cierre->get_egresos($nuevafecha.' 05:00:00',date('Y-m-d H:i:s'));
		$abonos = $cierre->get_abonos($nuevafecha.' 05:00:00',date('Y-m-d H:i:s'));
		$depositos = $cierre->get_depositos($nuevafecha.' 05:00:00',date('Y-m-d H:i:s'));
		$caja_cierre = $cierre->get_caja_cierre();
	} else {
		$venta['Total'] = $cerrado['Ventas'];
		$gastos['Total'] = $cerrado['Gastos'];
		$egresos['Total'] = $cerrado['Egresos'];
		$abonos['Total'] = $cerrado['Abonos'];
		$depositos['Total'] = $cerrado['Depositos'];
		$caja_cierre['Total'] = $cerrado['Dia_anterior'];
	}
?>
<span class="msj_deposito"></span>
<div class='col-sm-12'>
    <b>Saldo:</b>
    <input class="form-control" type="number" value='<?php echo number_format((($caja_cierre['Total']+$venta['Total']+$abonos['Total']-$gastos['Total']-$egresos['Total']-$depositos['Total'])),2,'.',''); ?>' id="tota_caja_deposito" disabled>
</div> 
<div class='col-sm-12'>
    <b>Cantidad a depositar:</b>
    <input class="form-control" type="text" value='<?php echo number_format((($caja_cierre['Total']+$venta['Total']+$abonos['Total']-$gastos['Total']-$egresos['Total']-$depositos['Total'])),2,'.',''); ?>' min="0" max='<?php echo number_format((($caja_cierre['Total']+$venta['Total']+$abonos['Total']-$gastos['Total']-$egresos['Total']-$depositos['Total'])),2,'.',''); ?>' id="saldo_deposito" >
</div>   