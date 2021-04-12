<?php
if (isset($_POST['login']) && isset($_POST['Usser']) && isset($_POST['Pass'])) {
    @session_start();
    include 'clases/clase_usuario.php';
    $usuario = new usuario();
        $data = $usuario->login_usuario($_POST['Usser'],md5($_POST['Pass']));
        if (!isset($data['Id_usuario'])) { ?>
            <script>
                document.addEventListener("DOMContentLoaded", function(event) {
                    sweetAlert('Los datos son incorectos...', 'Vuelva a intentarlo!', 'error');
                });
            </script>
        <?php }else{
            $_SESSION['Id'] = $data['Id_usuario'];
            $_SESSION['Nivel'] = $data['Nivel'];
            $_SESSION['Nombre'] = $data['Nombre'];
            $_SESSION['Id_sucursal'] = $data['Id_sucursales'];
            $_SESSION['Sucursal'] = $data['Sucursal'];
            $_SESSION['Tipo'] = $data['Tipo'];
            header('location: admin/');
        }
}?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset='UTF-8'>
    <meta name=description content=''>
    <meta name=viewport content='width=device-width, initial-scale=1'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link href='css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' type='text/css' href='css/dataTables.bootstrap.min.css'>
    <!-- This is what you need -->
    <script type="text/javascript" src="js/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert.css">
        <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/dataTables.bootstrap.min.js"></script>
    <style type="text/css">
        body {
            background: url(img/reliance.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="container" style="margin-top: 5%;" >
        <div class="row">
            <div class="col-md-5 col-md-offset-7">
                <div class="panel panel-default">
                    <div class="panel-heading"> <strong class="">Iniciar Sesion</strong>

                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Usuario</label>
                                <div class="col-sm-9">
                                    <input name="Usser" type="Text" class="form-control" id="inputEmail3" placeholder="Usuario" autocomplete="off" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">Contraseña</label>
                                <div class="col-sm-9">
                                    <input name="Pass" autocomplete="off" type="password" class="form-control" id="inputPassword3" placeholder="Contraseña" required="">
                                </div>
                            </div>
                            <!--<div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">Tipo Usuario</label>
                                <div class="col-sm-9">
                                    <select name="Tipo" class="form-control" required="">
                                        <option value="0">Seleccione Tipo Usuario</option>
                                        <option value="1">Usuario</option>
                                        <option value="2">Administrador</option>
                                    </select>
                                </div>
                            </div>-->
                            <div class="form-group last">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" name="login" class="btn btn-success btn-sm">Login</button>
                                    <button type="reset" class="btn btn-default btn-sm">Limpiar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">No Registrado? <a href="#" class="">Contacte a un Administrador</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>