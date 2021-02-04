<?php
@session_start();
if ($_POST['tipo']==1) {
    include '../clases/clase_detalle_cliente.php';
    $detalle_cliente = new detalle_cliente();
    $data = $detalle_cliente->buscar_cliente($_POST['cd_cliente'],$_POST['nrc_cliente']);
    include '../clases/clase_cliente.php';
    $cliente = new cliente();
    if (count($data)>0) {
        foreach ($data as $row) {?>
            <h4 class="modal-title">Cliente</h4>
            <input type='text' id='cd_cliente' value='<?php echo $row['Cod_cliente'] ?>' onchange='busclientes();' name='cd_cliente' class='form-control' placeholder='Cod_cliente'><br>
            <input type='text' id='nrc_cliente' value='<?php echo $row['Nrc'] ?>' onchange='busclientes();' name='nrc_cliente' class='form-control' placeholder='N° de Registro'><br>
            <input type='text' name='Nombre_cl' id='Nombre_cl' value='<?php $cliente1 = $cliente->get_id_cliente($row['Id_cliente']); echo $cliente1[0][2] ?>' class='form-control' placeholder='Nombre' required><br>
            <input type="hidden" name='operacion' id='operacion' value='1'>
            <input type="hidden" name='Id_cliente' id='Id_cliente' value='<?php echo $row['Id_cliente']; ?>'>
            <a href="#" class='btn btn-danger' onclick='clean(1);' ><span class="glyphicon glyphicon-trash"></span></a>
            <a href="#" data-toggle="modal" id="Btn_Modal_cliente" data-target="#Modal_cliente" class='btn btn-success'>Agregar Cliente</a>
        <?php }
    }else{?>
        <h4 class="modal-title">Cliente</h4>
        <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><i class="glyphicon glyphicon-ok-sign"></i></strong> El Cliente no existe! </div>
        <input type='text' id='cd_cliente' onchange='busclientes();' name='cd_cliente' class='form-control' placeholder='Cod_cliente'><br>
        <input type='text' id='nrc_cliente' onchange='busclientes();' name='nrc_cliente' class='form-control' placeholder='N° de Registro'><br>
        <input type='text' id='Nombre_cl' name='Nombre_cl' class='form-control' placeholder='Nombre' required><br>
            <input type="hidden" name='operacion' id='operacion' value='2'>
            <input type="hidden" name='Id_cliente' id='Id_cliente' value='0'>
        <a href="#" class='btn btn-danger' onclick='clean(1);' ><span class="glyphicon glyphicon-trash"></span></a>
        <a href="#" data-toggle="modal" id="Btn_Modal_cliente" data-target="#Modal_cliente" class='btn btn-success'>Agregar Cliente</a>
    <?php }
}elseif($_POST['tipo']==2){
    include '../clases/clase_mecanico.php';
    $mecanico = new mecanico();
    $data = $mecanico->buscar_mecanico($_POST['cd_mecanico'],$_POST['nit_mecanico']);
    if (count($data)>0) {
        foreach ($data as $row) { ?>
            <h4 class="modal-title">Mecanico</h4>
            <input type='text' name='cd_mecanico' value='<?php echo $row['Cod_mecanico']; ?>' id='cd_mecanico' onchange='busmecanico();' class='form-control' placeholder='Cod_mecanico'><br>
            <input type='text' name='Nombre_me' id='Nombre_me' value='<?php echo $row['Nombre']; ?>' class='form-control' placeholder='Nombre'><br>
            <input type='text' name='nit_mecanico' value='<?php echo $row['Nit']; ?>' id='nit_mecanico' onchange='busmecanico();' class='form-control' placeholder='Nit'><br>
            <input type="hidden" name='Id_mecanico' value='<?php echo $row['Id_mecanico']; ?>'>
            <a href="#" class='btn btn-danger' onclick='clean(2);' ><span class="glyphicon glyphicon-trash"></span></a>
            <a href="#" data-toggle="modal" id="Btn_Modal_mecanico" data-target="#Modal_mecanico" class='btn btn-success'>Agregar Mecanico</a>
        <?php }
    }else{?>
        <h4 class="modal-title">Mecanico</h4>
        <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><i class="glyphicon glyphicon-ok-sign"></i></strong> El Mecanico no existe! </div>
        <input type='text' name='cd_mecanico' id='cd_mecanico' onchange='busmecanico();' class='form-control' placeholder='Cod_mecanico'><br>
        <input type='text' name='Nombre_me' class='form-control' placeholder='Nombre'><br>
        <input type='text' name='nit_mecanico' id='nit_mecanico' onchange='busmecanico();' class='form-control' placeholder='Nit'><br>
        <input type="hidden" name='Id_mecanico' value='0'>
        <a href="#" class='btn btn-danger' onclick='clean(2);' ><span class="glyphicon glyphicon-trash"></span></a>
        <a href="#" data-toggle="modal" id="Btn_Modal_mecanico" data-target="#Modal_mecanico" class='btn btn-success'>Agregar Mecanico</a>
    <?php }
}elseif($_POST['tipo']==3){
    include '../clases/clase_vendedor.php';
    $vendedor = new vendedor();
    $data = $vendedor->buscar_vendedor($_POST['cod']);
    if (count($data)>0) {
        foreach ($data as $row) { ?>
            <h4 class="modal-title">Vendedor</h4>
            <input type='text' name='Cd_vendedor' value='<?php echo $row['Cod_vendedor'] ?>' onchange='busvendedor($(this).val());' class='form-control' placeholder='Cod_vendedor' required><br>
            <input type='text' name='Nombre_ve' value='<?php echo $row['Nombre'] ?>' class='form-control' placeholder='Nombre' required>
            <input type="hidden" name='Id_vendedor' value='<?php echo $row['Id_vendedor'] ?>'>
        <?php }
    }else{ ?>
        <h4 class="modal-title">Vendedor</h4>
        <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><i class="glyphicon glyphicon-ok-sign"></i></strong> El vendedor no existe! </div>
        <input type='text' name='Cd_vendedor' onchange='busvendedor($(this).val());' class='form-control' placeholder='Cod_vendedor' required><br>
        <input type='text' name='Nombre_ve' class='form-control' placeholder='Nombre' required>
        <input type="hidden" name='Id_vendedor' value='0'>
    <?php }
} ?>
