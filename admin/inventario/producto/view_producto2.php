<?php
include '../menu/menu.php';
include '../clases/clase_producto.php';
$producto = new producto();
$data = $producto->get_producto();

include '../clases/clase_proveedor.php';
$proveedor = new proveedor();
include '../clases/clase_ubicacion.php';
$ubicacion = new ubicacion();
include '../clases/clase_precio.php';
$precio = new precio();	?>
	<ol class="breadcrumb">
	  <li><a  href="../admin/" style="cursor: pointer;">Reliance</a></li>
	  <li class="active">Inventario</li>
	</ol>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h1 class='text-center'>Inventario</h1>
		</div>
		<div class="panel-body">
			<a href="add_producto.php" class='btn btn-info'>Nuevo producto</a> 
			<?php if (isset($_SESSION['Id']) && isset($_SESSION['Nivel']) && $_SESSION['Nivel'] == 2 || $_SESSION['Nivel'] == 3) { ?>
			<a href="inventario.php" class='btn btn-info'>Imprimir inventario</a><br><br>
			<?php } ?>
			<div class='table-responsive' style="margin-top: 1%">
				<table class='table table-bordered table-hover' id='tabla_datos'>
					<thead>
						<tr>
							<th>Cod_producto</th>
							<th>Cod_oem</th>
							<th>Cod_remplazo</th>
							<th>Cantidad</th>
							<th>Nombre</th>
							<th>Descripcion</th>
							<th>Proveedor</th>
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
                                        ?> style="cursor: pointer;"<?php } ?> onclick="modal('<?php echo $row['Id_producto'] ?>');">
							<td><?php echo $row['Cod_producto'] ?></td>
							<td><?php echo $row['Cod_oem'] ?></td>
							<td><?php $cod_reemplazo = $producto->get_id_cod_reemplazo($row['Id_producto']); echo $cod_reemplazo[0][1]; ?></td>
							<td><?php echo $precio1[0][1]; ?></td>
							<td><?php echo $row['Nombre'] ?></td>
							<td><?php echo $row['Descripcion'] ?></td>
							<td><?php $proveedor1 = $proveedor->get_id_proveedor($row['Id_proveedor']); echo $proveedor1[0][1] ?></td>
						</tr>
						<?php $i++; }?>
					</tbody>
				</table>
				<nav class="pagi text-right" style="margin-top: -2%">
			 		<ul class="pagination"></ul>
				</nav>
			</div>
		</div>
	</div>
<?php include '../pie/pie.php'; ?>
<script>
	function kardex(id) {
	     $.ajax({
	            url: "kardex.php",
	            type : 'post',
	            dataType: 'html',
	            data: {
	                ID: id
	            },
	        })
	        .done(function(data) {
	        	document.getElementById('contenido-kardex').innerHTML = data;
	            $('#kardex').show();
	            $('.tabla_datos').DataTable( {
		            "language": {
		                "lengthMenu": "Mostrar _MENU_ Registros por pagina",
		                "zeroRecords": "No hay resultados - lo siento",
		                "info": "Mostrando _PAGE_ de _PAGES_ paginas",
		                "infoEmpty": "No hay resultados - lo siento",
		                "sSearch": "Buscar: ",
		                "infoFiltered": "( En _MAX_ Registros)"
		            }
		        } );
	        })
	        .fail(function() {
	            console.log("error");
	        })
	        .always(function() {
	            $('#img').html("");
	        });   
	}
	function buscar(dato,tipo){
		if (dato != '') {
			//alert(dato+' Tipo: '+tipo);
			$('#img').html("<img src='../img/cargando.gif' width=30 height=30/>");
			console.log(dato);
			$.ajax({
				url: "agregar_pu.php",
				type : 'post',
				dataType: 'html',
				data: {
					dato: dato,
					tipo: tipo
				},
			})
			.done(function(data) {
				if (tipo == 1) {
					$('#Id_proveedor').val(data);
				}else if(tipo == 2){
					if (data > 0) {
						$('#Id_ubicacion').val(data);
					}else{
						$('#ubicacion').val('');
					}
				}
				console.log('hola');
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				$('#img').html("");
				console.log('hola');
			});
        }
	}
</script>
<script>
	function fact(id) {
        $.ajax({
          url: "generar_reporte.php",
          type : 'post',
          data: {
            id: id,
            tipo: 2
          },
          beforeSend: function(){
            $('#img').html("<img src='../img/cargando.gif' width=30 height=30/>");
          },
          success: function( result ) {
            $('#Modal_vista_factura_contenido').html(result);
            $('#Modal_vista_factura').show();
            $('#img').html("");
          }
        });
    }
</script>
