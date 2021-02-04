<?php 
include '../clases/clase_producto.php';
include '../clases/clase_precio.php';
$precio = new precio();
$producto = new producto();
$kardex = $_POST['ID'];
$data = $producto->get_id_producto($kardex);
$kardex_salidas = $producto->kardex_salidas($kardex);
$kardex_entradas = $producto->kardex_entradas($kardex);
$kardex_ventas = $producto->kardex_ventas($kardex);
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" onclick="$('#kardex').hide();">&times;</button>
	<h4 class="modal-title">Kardex</h4>
</div>
<div class="modal-body">
	<div class="row">
		<ul class="nav nav-tabs">
			<li class="active ven" style="cursor: pointer;"><a onclick="$('.en').removeClass('active');$('.sa').removeClass('active');$('.st').removeClass('active');$('.ven').addClass('active');$('#ventas').show();$('#entradas').hide();$('#salidas').hide();">Ventas</a></li>
			<li class="en" style="cursor: pointer;"><a onclick="$('.ven').removeClass('active');$('.sa').removeClass('active');$('.en').addClass('active');$('#ventas').hide();$('#entradas').show();$('#salidas').hide();$('#stock').hide();">Entradas</a></li>
			<li class="sa" style="cursor: pointer;"><a onclick="$('.en').removeClass('active');$('.ven').removeClass('active');$('.st').removeClass('active');$('.sa').addClass('active');$('#ventas').hide();$('#entradas').hide();$('#stock').hide();$('#salidas').show();">Salidas</a></li>
			<li class="st" style="cursor: pointer;"><a onclick="$('.en').removeClass('active');$('.ven').removeClass('active');$('.sa').removeClass('active');$('.st').addClass('active');$('#ventas').hide();$('#entradas').hide();$('#salidas').hide();$('#stock').show();">Stock</a></li>
		</ul>
		<div class="col-sm-12" id="ventas">
			<div class='table-responsive' style="margin-top: 1%">
				<center><b>VENTAS</b></center>
				<table class='table table-bordered table-hover tabla_datos'>
					<thead>
						<tr>
							<th>Cod</th>
							<th>Fecha</th>
							<th>N Comprobante</th>
							<th>Cantidad</th>
						</tr>
					</thead>
					<tbody class="result">
						<?php
						$i = 0;
						$h = 1;
						foreach ($kardex_ventas as $row) {
							?>
						<tr onclick="fact(<?php echo $row['Id_pedido'] ?>);" style="cursor: pointer; ">
							<td><?php echo $row['Cod_producto'] ?></td>
							<td><?php echo $row['Fecha'] ?></td>
							<td><?php echo $row['Numero'] ?></td>
							<td><?php echo $row['Cantidad'] ?></td>
						</tr>
						<?php $i++; }?>
					</tbody>
				</table>
				<nav class="pagi text-right" style="margin-top: -2%">
			 		<ul class="pagination"></ul>
				</nav>
			</div>
		</div>
		<div class="col-sm-12"  id="entradas" hidden="hidden">
			<div class='table-responsive' style="margin-top: 1%">
				<center><b>ENTRADAS</b></center>
				<table class='table table-bordered table-hover tabla_datos'>
					<thead>
						<tr>
							<th>Cod</th>
							<th>Fecha</th>
							<th>Numero</th>
							<th>Cantidad</th>
						</tr>
					</thead>
					<tbody class="result">
						<?php
						$i = 0;
						$h = 1;
						foreach ($kardex_entradas as $row) {
							?>
						<tr>
							<td><?php echo $row['Cod_producto'] ?></td>
							<td><?php echo $row['Fecha'] ?></td>
							<td><?php echo $row['Numero'] ?></td>
							<td><?php echo $row['Cantidad'] ?></td>
						</tr>
						<?php $i++; }?>
					</tbody>
				</table>
				<nav class="pagi text-right" style="margin-top: -2%">
			 		<ul class="pagination"></ul>
				</nav>
			</div>
		</div>
		<div class="col-sm-12"  id="salidas" hidden="hidden">
			<div class='table-responsive' style="margin-top: 1%">
				<center><b>SALIDAS</b></center>
				<table class='table table-bordered table-hover tabla_datos'>
					<thead>
						<tr>
							<th>Cod</th>
							<th>Fecha</th>
							<th>Numero</th>
							<th>Cantidad</th>
						</tr>
					</thead>
					<tbody class="result">
						<?php
						$i = 0;
						$h = 1;
						foreach ($kardex_salidas as $row) {
							?>
						<tr>
							<td><?php echo $row['Cod_producto'] ?></td>
							<td><?php echo $row['Fecha'] ?></td>
							<td><?php echo $row['Numero'] ?></td>
							<td><?php echo $row['Cantidad'] ?></td>
						</tr>
						<?php $i++; }?>
					</tbody>
				</table>
				<nav class="pagi text-right" style="margin-top: -2%">
			 		<ul class="pagination"></ul>
				</nav>
			</div>
		</div>
		<div class="col-sm-12" id="stock"  hidden="hidden">
			<div class='table-responsive' style="margin-top: 1%">
				<center><b>STOCK</b></center>
				<table class='table table-bordered table-hover tabla_datos'>
					<thead>
						<tr>
							<th>Cod_producto</th>
							<th>Nombre</th>
							<th>Stock</th>
						</tr>
					</thead>
					<tbody class="result">
						<?php
						$i = 0;
						$h = 1;
						foreach ($data as $row) {
							if ($i == 5) {
								$h++;
								$i = 0;
							}
							$precio1 = $precio->get_precio_id_producto($row['Id_producto']);
							?>
						<tr <?php if ($precio1[0][1] == 0) { ?> class="danger" style="cursor: pointer;" <?php }else{
                                        ?> style="cursor: pointer;"<?php } ?> style="cursor: pointer;" onclick="modal('<?php echo $row['Id_producto'] ?>');">
							<td><?php echo $row['Cod_producto'] ?></td>
							<td><?php echo $row['Nombre'] ?></td>
							<td><?php echo $precio1[0][1]; ?></td>
						</tr>
						<?php $i++; }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer">
	<a href="#" class="btn btn-danger" data-dismiss="modal" onclick="$('#kardex').hide();">Cerrar</a>
</div>
