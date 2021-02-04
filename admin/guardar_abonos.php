<?php 
	include '../clases/clase_abonos.php';
	$abonos = new abonos();
	if (!empty($_POST['Abono']) && !empty($_POST['Dato'])) {
		if ($abonos->add_abonos($_POST['Dato'],$_POST['Abono']) == 0) { ?>
			<?php 
			$abonos = new abonos();
			$encabezado_fact = $abonos->get_factura_id($_POST['Dato']);
			?>
			<div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" onclick="$('#Modal_abonos_factura').hide();">&times;</button>
			    <h4 class="modal-title">Abonar factura factura</h4>
			</div>
			<div class="modal-body">
			    <div class="row">
			         <div class='col-sm-12'>
			            <table class="table table-bordered table-hover">
			                <thead>
			                    <tr>
                                    <th>Fecha</th>
                                    <th>Factura N°</th>
                                    <th>Cliente</th>
                                    <th>Monto</th>
                                    <th>Descuento</th>
                                    <th>Monto Total</th>
                                    <th>Abono Total</th>
                                    <th>Monto Pendiente</th>
                                </tr>
			                </thead>
			                <tbody>
			                    <tr>
			                        <td><?php echo $encabezado_fact['Fecha']; ?></td>
			                        <td><?php echo  ($encabezado_fact['N_fac']==0) ? $encabezado_fact['Serie']." ".$encabezado_fact['N_ccf'] : $encabezado_fact['Serie']." ".$encabezado_fact['N_fac'] ; ?></td>
			                        <td><?php echo $encabezado_fact['Cliente']; ?></td>
			                        <td><?php echo "$".number_format($encabezado_fact['Compra_total'],2,'.',','); ?></td>
			                        <td><?php echo "$".number_format($encabezado_fact['Descuento_compra'],2,'.',','); ?></td>
                                    <td><?php echo "$".number_format(($encabezado_fact['Compra_total']-$encabezado_fact['Descuento_compra']),2,'.',','); ?></td>
			                        <td><?php echo "$".number_format($encabezado_fact['Abono'],2,'.',','); ?></td>
			                        <td><?php echo "$".number_format((($encabezado_fact['Compra_total']-$encabezado_fact['Descuento_compra'])-$encabezado_fact['Abono']),2,'.',','); ?></td>
			                    </tr>
			                </tbody>
			            </table>
			            <h4>Cantidad abonar: </h4>
			            <input type="hidden" id="dato" value="<?php echo $_POST['id']; ?>">
			            <input value="<?php echo number_format((($encabezado_fact['Compra_total']-$encabezado_fact['Descuento_compra'])-$encabezado_fact['Abono']),2,'.',',') ?>" max="<?php echo number_format((($encabezado_fact['Compra_total']-$encabezado_fact['Descuento_compra'])-$encabezado_fact['Abono']),2,'.',',') ?>" min="0" class="form-control" type='number' step="any" name="Abono" id="Abono" placeholder="Abono" <?php echo (number_format(($encabezado_fact['Compra_total']-$encabezado_fact['Descuento_compra']),2,'.',',') != number_format($encabezado_fact['Abono'],2,'.',',')) ? '' : 'disabled' ; ?>>
			        </div>
			    </div>
			 </div>
			 <div class="modal-footer">
			    <?php if (number_format(($encabezado_fact['Compra_total']-$encabezado_fact['Descuento_compra']),2,'.',',') != number_format($encabezado_fact['Abono'],2,'.',',')) { ?>
			        <a href='#' class='btn btn-success' onclick="AddAbonos();">Guardar</a>
			    <?php } ?>
			    <a href="#" class="btn btn-danger" data-dismiss="modal" onclick="$('#Modal_abonos_factura').hide();">Cerrar</a>
			</div>
		<?php 
		}
	}
?>