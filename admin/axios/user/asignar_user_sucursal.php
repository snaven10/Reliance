<?php
include '../../../clases/clase_usuario.php';
$usuario = new usuario();
$user = json_decode(file_get_contents('php://input'),true);
if(isset($user['id_user']) && isset($user['id_sucursal'])){
    if ($usuario->asignar_sucursal($user['id_user'],$user['id_sucursal']) == 0) {
        echo 'success,se asigno la sucursal con exito';
    } else {
        echo 'error,A ocurrido un error al asignar la sucursal';
    }
}