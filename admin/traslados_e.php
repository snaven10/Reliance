<?php
@session_start();
$N_traslado = '';
$disabled = '';
if (isset($_SESSION['N_traslado'][0])) {
	if ($_SESSION['N_traslado'][0] != '') {
		$N_traslado = $_SESSION['N_traslado'][0];
		$disabled = 'disabled';
	}
}
include '../menu/menu.php';
include '../clases/clase_producto.php';
$producto = new producto();
$data = $producto->get_producto($_SESSION['Id_sucursal']);
include '../clases/clase_proveedor.php';
$proveedor = new proveedor();
include '../clases/clase_ubicacion.php';
$ubicacion = new ubicacion();
include '../clases/clase_sucursales.php';
$sucursales = new sucursales();
$sucursal = $sucursales->mostrar_sucursales($_SESSION['Sucursal']);
?>
<ol class="breadcrumb">
<li><a href="../admin/" style="cursor: pointer;">Reliance</a></li>
<li class="active">Entradas de producto</li>
</ol>
<div class="panel panel-primary">
<div class="panel-heading">
	<h1 class='text-center'>Traslado de producto</h1>
</div>
<div class="panel-body">
	<center><a onclick="eliminar_trasladosentr(0,1)" class='btn btn-info'>Reset</a></center><br>-
	<div id="entradas">
		<div class="col-xs-6">
			<input type="text" value="<?= $N_traslado ?>" id="N_traslado" class="form-control"
				placeholder='N de traslado' required <?= $disabled; ?>><br>
			<input id="Cod" list="Cod_producto" class="form-control" onchange="buscar($(this).val())"
				placeholder='Cod producto' required>
			<datalist id="Cod_producto">
				<?php
							foreach ($data as $row){ ?>
				<option value="<?= $row['Cod_producto'] ?>"></option>
				<?php } ?>
			</datalist><br>
			<input type="number" class="form-control" id="Precio_compra" placeholder="Precio Compra"
				required><br>
			<input type="number" class="form-control" id="Cantidad" placeholder="Cantidad" required>
		</div>
		<div class="col-xs-6">
			<select name="Sucursal" id="Sucursal" class="form-control">
				<?php foreach ($sucursal as $row): ?>
					<option value="<?= $row['Id_sucursales'] ?>"><?= $row['Sucursal'] ?></option>
				<?php endforeach ?>
			</select><br>
			<input type="text" class="form-control" id="Nombre_proc" placeholder="Nombre_producto" disabled><br>
			<input type="number" class="form-control" id="Precio_Venta" placeholder="Precio Venta" required><br>
			<input type="number" class="form-control" id="Descuento" placeholder="Descuento" required>
		</div>
	</div>
	<div class="col-xs-12"><br>
		<table class="table table-striped table-bordered">
			<tbody>
				<tr>
					<td>
						<a href="#" class="btn btn-success aTrasladosEnt">Agregar</a>
						<a href="guardar_trasladosente.php?guardar=1" class="btn btn-primary"
							style="float: right;">Guardar Entrada</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-xs-12"><br>
		<table class='table table-striped table-bordered' id='tabla_datos'>
			<CENTER>
				<h2>REPORTE DE ENTRADAS <?= date('d-m-Y'); ?></h2>
			</CENTER>
			<thead>
				<tr>
					<th>N de Traslado</th>
					<th>Cod Producto</th>
					<th>Nombre</th>
					<th>Cantidad</th>
					<th>Precio_C</th>
					<th>Precio_V</th>
					<th>Sucursal</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody class="result" id='mostrar-entradas'>
				<?php if (isset($_SESSION['n_trasentr'])):
					for ($i=0; $i < $_SESSION['n_trasentr']; $i++):
						if ($_SESSION["p_trasentr"][$i] != null):
							$r = $_SESSION["p_trasentr"][$i];
							foreach ($r as $k):
								if($k[0] != null): ?>
									<tr>
										<td><?= $k[6]; ?></td>
										<td><?= $k[0]; ?></td>
										<td><?php $data = $producto->get_producto_cod($k[0]);  echo $data[0][3]; ?></td>
										<td><?= $k[1]; ?></td>
										<td><?= $k[2]; ?></td>
										<td><?= $k[3]; ?></td>
										<td><?= $k[7]; ?></td>
										<td><a class='btn btn-danger' onclick='eliminar_trasladosentr(<?= $i; ?>,0)'
												id='eliminar_ss'><span class='glyphicon glyphicon-remove'></span></a></td>
									</tr>
								<?php endif;
							endforeach;
						endif;
					endfor;
				endif ?>
			</tbody>
		</table>
	</div>
</div>
</div>
<?php include '../pie/pie.php'; ?>
<script>
function buscar(dato) {
    var N_traslado = $('#N_traslado').val();
    if (N_traslado != '') {
        if (dato != '') {
            $("#N_fact").find('.text-danger').remove();
            //console.log(dato);
            $.ajax({
                    url: "agregar_traslado.php",
                    type: 'post',
                    dataType: 'html',
                    data: {
                        n_traslado: N_traslado,
                        dato: dato,
                        Sa: 0
                    },
                })
                .done(function(data) {
                    document.getElementById('entradas').innerHTML = data;
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    $('#img').html("");
                });
        }
    } else {
        $("#Cod").val('');
        $("#N_traslado").after('<p class="text-danger">Este campo es obligatorio</p>');
        $('#N_traslado').closest('.form-group').addClass('has-error');
    }
}
			</script>