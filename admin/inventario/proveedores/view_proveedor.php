<?php
				include '../menu/menu.php';
				/*if (!isset($_POST['validacion'])) {
					if (basename($_SERVER["PHP_SELF"]) != 'index.php') {
						header('location: ../admin');
					}
				}*/
				include '../clases/clase_proveedor.php';

				$proveedor = new proveedor();

				$data = $proveedor->get_proveedor();
				
		?>
					<ol class="breadcrumb">
					  <li><a onclick="contenido('view_proveedor.php');">Reliance</a></li>
					  <li class="active">proveedor</li>
					</ol>
					<div class="panel panel-primary"> 
						<div class="panel-heading"> 
							<h1 class='text-center'>proveedor</h1>
						</div> 
						<div class="panel-body"> 
							<a href='add_proveedor.php' class='btn btn-info'>Nuevo proveedor</a>  <a href="#" onclick="imprimir_pr()" class='btn btn-primary'>Imprimir</a><br><br>
							<div class='table-responsive'>
								<table class='table table-striped table-bordered' id='tabla_datos'>
									<thead>
										<tr> 
											<td>Cod_proveedor</td>
											<td>Nombre</td>
											<td>Nit_empresa</td>
											<td>Telefono</td>
											<td>Direccion</td>
											<td>Email</td>
											<td class='text-center'><b>Opciones</b></td>
										</tr>
									</thead>
									<?php
									foreach ($data as $row) {?>
									<tr> 
										<td><?php echo $row['Id_proveedor'] ?></td>
										<td><?php echo $row['Nombre'] ?></td>
										<td><?php echo $row['Nit_empresa'] ?></td>
										<td><?php echo $row['Telefono'] ?></td>
										<td><?php echo $row['Direccion'] ?></td>
										<td><?php echo $row['Email'] ?></td>
										<td><a href='add_proveedor.php?id=<?php echo $row[0] ?>' class='btn btn-info'>Editar</a></td>				
									</tr>
									<?php }?>
								</table>
							</div>	 
						</div> 
					</div>
					<div hidden="" id="proveedores_prim">
						<center><h1>Reporte de Proveedores</h1></center>
						<table class='table table-striped table-bordered' id='tabla_datos'>
							<thead>
								<tr> 
									<td>Cod_proveedor</td>
									<td>Nombre</td>
									<td>Nit_empresa</td>
									<td>Telefono</td>
									<td>Direccion</td>
									<td>Email</td>
								</tr>
							</thead>
							<?php
							foreach ($data as $row) {?>
							<tr> 
								<td><?php echo $row['Id_proveedor'] ?></td>
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
        var contenido= document.getElementById('proveedores_prim').innerHTML;
        var contenidoOriginal= document.body.innerHTML;
        document.body.innerHTML = contenido;
        window.print();
        document.body.innerHTML = contenidoOriginal;
    }
	function borrar(id)
	{
		swal
		({
		  title: '¿Seguro que desea eliminar este registro?',
		  text: "¡No podras revertir esto!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancelar',
		  confirmButtonText: 'Si, ¡Deseo Borrarlo!'
		}).then((result) => {
		  if (result.value) 
		  {
			  location.href='del_estado.php?id='+id;
		  }
		});
	}
</script>