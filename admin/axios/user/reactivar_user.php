<?php
include '../../../clases/clase_usuario.php';
$usuario = new usuario();
$user = json_decode(file_get_contents('php://input'),true);
if(isset($user['id'])){
    if ($usuario->reactivar_use($user['id']) == 0) {
        echo 'success,se a reactivado el usuario con exito';
    } else {
        echo 'error,A ocurrido un error al reactivar el usuario';
    }
}