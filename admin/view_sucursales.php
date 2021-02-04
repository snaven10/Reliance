<?php
				include '../menu/menu.php';
				/*if (!isset($_POST['validacion'])) {
					if (basename($_SERVER["PHP_SELF"]) != 'index.php') {
						header('location: ../admin');
					}
				}*/
				include '../clases/clase_sucursales.php';

				$sucursales = new sucursales();

				$data = $sucursales->get_sucursales();
				
		?>
					<ol class="breadcrumb">
					  <li><a onclick="contenido('view_sucursales.php');">Reliance</a></li>
					  <li class="active">sucursales</li>
					</ol>
					<div class="panel panel-primary"> 
						<div class="panel-heading"> 
							<h1 class='text-center'>Sucursales</h1>
						</div> 
						<div class="panel-body"> 
							<!--<a href='add_sucursales.php' class='btn btn-info'>Nueva Sucursal</a>  <a href="#" onclick="imprimir_pr()" class='btn btn-primary'>Imprimir</a><br><br>-->
							<div class='table-responsive'>
								<table class='table table-striped table-bordered' id='tabla_datos'>
									<thead>
										<tr> 
											<td>Cod_Sucursal</td>
											<td>Sucursal</td>
											<td>Direccion</td>
											<td>Casa matris</td>
										</tr>
									</thead>
									<?php
									foreach ($data as $row) {?>
									<tr class="<?php echo  ($row['Tipo'] == 1) ? 'success' : '' ?>"> 
										<td><?php echo $row['Id_sucursales'] ?></td>
										<td><?php echo $row['Sucursal'] ?></td>
										<td><?php echo $row['Direccion'] ?></td>
										<td><?php echo ($row['Tipo'] == 1) ? 'Casa Matris' : 'Sucursal <span onclick="cambio_matris('.$row['Id_sucursales'].');" class="btn btn-info glyphicon glyphicon-circle-arrow-up"></span>' ; ?></td>		
									</tr>
									<?php }?>
								</table>
							</div>	 
						</div> 
					</div>
					<div hidden="" id="sucursales_prim">
						<center><h1>Reporte de Sucursales</h1></center>
						<table class='table table-striped table-bordered' id='tabla_datos'>
							<thead>
								<tr> 
									<td>Cod_Sucursal</td>
									<td>Sucursal</td>
									<td>Direccion</td>
									<td>Casa matris</td>
								</tr>
							</thead>
							<?php
							foreach ($data as $row) {?>
							<tr> 
								<td><?php echo $row['Id_sucursales'] ?></td>
								<td><?php echo $row['Nombre'] ?></td>
								<td><?php echo $row['Nit_empresa'] ?></td>
								<td><?php echo $row['Telefono'] ?></td>
								<td><?php echo $row['Direccion'] ?></td>
								<td><?php echo $row['Email'] ?></td>	
							</tr>
							<?php }?>
						</table>
					</div>
<?php include '../pie/pie.php';  ?>		
<script language='javascript'>
	function imprimir_pr() {
        var contenido= document.getElementById('sucursales_prim').innerHTML;
        var contenidoOriginal= document.body.innerHTML;
        document.body.innerHTML = contenido;
        window.print();
        document.body.innerHTML = contenidoOriginal;
    }
	function cambio_matris(dato)
	{
		$.ajax({
            url: "cambio_matris.php",
            type : 'post',
            dataType: 'html',
            data: {
                Dato: dato
            },
        })
        .done(function(data) {
            location.href='';
        })
        .fail(function() {
            console.log("error");
        }); 
	}
</script>