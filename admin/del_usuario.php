<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="../js/sweetalert.all.js"></script>
	<link rel="stylesheet" href="../css/sweetalert.css">
</head>
<body>
</body>
</html>
<?php
if (!empty($_GET['id'])) {
	include '../clases/clase_usuario.php';
	$usuario = new usuario();
	if ($usuario->del_usuario($_GET['id']) == 0) { ?>
			<script>
			swal
				({
					position: 'center',
					type: 'success',
					title: 'Se elimino con exito',
					showConfirmButton: false,
					timer: 1500
				});
				setTimeout ("location.href='view_usuario.php';", 1500); //tiempo expresado en milisegundos
			</script>
			<?php
	}else{ ?>
			<script>
			swal
				({
					position: 'center',
					type: 'error',
					title: 'Ocurrio un error al borrar!',
					showConfirmButton: false,
					timer: 1500
				});
				setTimeout ("location.href='view_usuario.php';", 1500);
			</script>
			<?php
	}
}else{ ?>
			<script>location.href='view_usuario.php';</script>
			<?php
}
?>