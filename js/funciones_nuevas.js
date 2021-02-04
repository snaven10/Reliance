//abonos
function AddAbonos() {
   var Abono = $("#Abono").val();
   var dato = $("#dato").val();
   var datos = $("#Abono");
   //alert(datos.attr('max'));
   if (Abono == '') {
        $("#Abono").after('<p class="text-danger">Este campo es obligatorio</p>');
        $('#Abono').closest('.form-group').addClass('has-error');
    }else if(Abono > datos.attr('max')){
        $("#Abono").after('<p class="text-danger">El monto abonar no puede ser mayor al monto pendiente</p>');
        $('#Abono').closest('.form-group').addClass('has-error');
        $("#Abono").val(datos.attr('max'));
    }else if(Abono < 0.01){
        $("#Abono").after('<p class="text-danger">El monto abonar no puede ser menor a $0.01</p>');
        $('#Abono').closest('.form-group').addClass('has-error');
        $("#Abono").val(datos.attr('max'));
    }else{
        $("#Abono").find('.text-danger').remove();
        $("#Abono").closest('.form-group').addClass('has-success');
        $.ajax({
            url: 'guardar_abonos.php',
            type : 'post',
            dataType: 'html',
            data: {
                Abono: Abono,
                Dato:dato
            },
        })
        .done(function(data) {
            document.getElementById('contenido-abonos-factura').innerHTML = data;
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
    }
}

function eliminar_trs(pos) {
    $.ajax({
            url: '../admin/eliminar_trs.php',
            type: 'POST',
            dataType: 'html',
            data: {pos:pos},
        })
        .done(function(data) {
            $('#mostrar-salidas').html(data);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
}


function eliminar_trasladosentr(pos,tipo) {
    if (tipo == 1) {
        $('#N_traslado').removeAttr('disabled');
        $('#N_traslado').val('');
        $.ajax({
                url: '../admin/eliminar_trasladosentr.php',
                type: 'POST',
                dataType: 'html',
                data: {pos:pos,tipo:tipo},
            })
            .done(function(data) {
                $('#mostrar-entradas').html(data);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    }else if(tipo == 0){
        $.ajax({
                url: '../admin/eliminar_trasladosentr.php',
                type: 'POST',
                dataType: 'html',
                data: {pos:pos,tipo:tipo},
            })
            .done(function(data) {
                $('#mostrar-entradas').html(data);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    }
}

function modal_abonos(Id){
    $.ajax({
        url: 'cargar_modal_abonos.php',
        async:true,
        dataType:"html",
        type: 'POST',
        data: {id: Id },
    })
    .done(function(data) {
        document.getElementById('contenido-abonos-factura').innerHTML = data;
        $("#Modal_abonos_factura").show();
        data_table();
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
}

function modal_depositos(argument) {
    $("#Modal_depositos").show();
    $.ajax({
            url: 'datos_deposito.php',
            async:true,
            dataType:"html",
            type: 'POST'
        })
        .done(function(data) {
            $('.datos_deposito').html(data);
        }); 
}

function guardar_deposito() {
    saldo_deposito = $('#saldo_deposito').val();
    tota_caja_deposito = $('#tota_caja_deposito').val();
    datos = $('#saldo_deposito');
    //alert(saldo_deposito);
    if(saldo_deposito == '') {
        $("#consultar_series").after('<p class="text-danger"> Este campo es obligatorio</p>');
        $('#consultar_series').closest('.form-group').addClass('has-error');
        return false;
    }else if(saldo_deposito > datos.attr('max')){
        $("#saldo_deposito").after('<p class="text-danger">El deposito no puede ser mayor al saldo de caja</p>');
        $('#saldo_deposito').closest('.form-group').addClass('has-error');
        $("#saldo_deposito").val(datos.attr('max'));
    }else if(saldo_deposito < 0.01){
        $("#saldo_deposito").after('<p class="text-danger">El deposito no puede ser menor a $0.01</p>');
        $('#saldo_deposito').closest('.form-group').addClass('has-error');
        $("#saldo_deposito").val(datos.attr('max'));
    }else{
        $("#consultar_series").find('.text-danger').remove();
        $("#consultar_series").closest('.form-group').addClass('has-success');
         $.ajax({
            url: "add_efectivo.php",
            type : 'post',
            dataType: 'html',
            data: {
                saldo_deposito: saldo_deposito,
                tipo: 1
            },
        })
        .done(function(data) {
            $('#Modal_depositos').hide();
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            $('#img').html("");
        }); 
       
    }        
}
function guardar_gasto() {
    Descripcion = $('#Descripcion').val();
    Monto = $('#Monto').val();
    if(Descripcion == '') {
        $("#Descripcion").after('<p class="text-danger"> Este campo es obligatorio</p>');
        $('#Descripcion').closest('.form-group').addClass('has-error');
        return false;
    }else if(Monto == '') {
        $("#Monto").after('<p class="text-danger"> Este campo es obligatorio</p>');
        $('#Monto').closest('.form-group').addClass('has-error');
        return false;
    }else if(Monto < 0.01){
        $("#Monto").after('<p class="text-danger">El monto no puede ser menor a $0.01</p>');
        $('#Monto').closest('.form-group').addClass('has-error');
        $("#Monto").val(datos.attr('max'));
    }else{
        $("#Descripcion").find('.text-danger').remove();
        $("#Descripcion").closest('.form-group').addClass('has-success');
        $("#Monto").find('.text-danger').remove();
        $("#Monto").closest('.form-group').addClass('has-success');
        $.ajax({
            url: "add_efectivo.php",
            type : 'post',
            dataType: 'html',
            data: {
                Descripcion: Descripcion,
                Monto: Monto,
                tipo: 2
            },
        })
        .done(function(data) {
            $('#Descripcion').val('');
            $('#Monto').val('');
            $('.msj_gasto').html(data);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            $('#img').html("");
        });  
    } 
}

function guardar_egresos() {
    Descripcion = $('#Descripcion-e').val();
    Monto = $('#Monto-e').val();
    if(Descripcion == '') {
        $("#Descripcion").after('<p class="text-danger"> Este campo es obligatorio</p>');
        $('#Descripcion').closest('.form-group').addClass('has-error');
        return false;
    }else if(Monto == '') {
        $("#Monto").after('<p class="text-danger"> Este campo es obligatorio</p>');
        $('#Monto').closest('.form-group').addClass('has-error');
        return false;
    }else if(Monto < 0.01){
        $("#Monto").after('<p class="text-danger">El monto no puede ser menor a $0.01</p>');
        $('#Monto').closest('.form-group').addClass('has-error');
        $("#Monto").val(datos.attr('max'));
    }else{
        $("#Descripcion").find('.text-danger').remove();
        $("#Descripcion").closest('.form-group').addClass('has-success');
        $("#Monto").find('.text-danger').remove();
        $("#Monto").closest('.form-group').addClass('has-success');
        $.ajax({
            url: "add_efectivo.php",
            type : 'post',
            dataType: 'html',
            data: {
                Descripcion: Descripcion,
                Monto: Monto,
                tipo: 3
            },
        })
        .done(function(data) {
            $('#Descripcion-e').val('');
            $('#Monto-e').val('');
            $('.msj_gasto').html(data);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            $('#img').html("");
        });  
    } 
}

//traslados
function Buscar_traslados(Id) {
    var Tipo = 1;
    $.ajax({
        url: 'reporte_entradas_traslados.php',
        async:true,
        dataType:"html",
        type: 'POST',
        data: {id: Id, tipo: Tipo },
    })
    .done(function(data) {
        console.log("success");
        $('#contenido-modal-reportes').html(data);
        $("#Modal_reportes").show();
        $('#tabla_datoss').DataTable( {
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
        console.log("complete");
    });

}

function Buscar_trs(Id) {
    var Tipo = 1;
    $.ajax({
        url: 'reporte_trs.php',
        async:true,
        dataType:"html",
        type: 'POST',
        data: {id: Id, tipo: Tipo },
    })
    .done(function(data) {
        console.log("success");
        $('#contenido-modal-reportes').html(data);
        $("#Modal_reportes").show();
        $('#tabla_datoss').DataTable( {
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
        console.log("complete");
    });

}

//fin traslados

$(function(event){
    // funciones de traslados
    $(".aTrasladosEnt").click(function(event) {
        var N_tras = $('#N_traslado').val(), 
        Proveedor = $('#Proveedor').val(),
        Cod = $('#Cod').val(),
        Can = $('#Cantidad').val(),
        Pre_c = $('#Precio_compra').val(),
        Pre_v = $('#Precio_Venta').val(),
        Des = $('#Descuento').val(),
        Nom = $('#Nombre_proc').val();
        suc = $('#Sucursal').val();
        if (N_tras == '') {
            $("#N_traslado").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#N_traslado').closest('.form-group').addClass('has-error');
        }else if (Cod == '') {
            $("#Cod").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Cod').closest('.form-group').addClass('has-error');
        }else if(Can == ''){
            $("#Cantidad").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Cantidad').closest('.form-group').addClass('has-error');
        }else if(Pre_c == ''){
            $("#Precio_compra").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Precio_compra').closest('.form-group').addClass('has-error');
        }else if(Pre_v == ''){
            $("#Precio_Venta").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Precio_Venta').closest('.form-group').addClass('has-error');
        }else if(Des == ''){
            $("#Descuento").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Descuento').closest('.form-group').addClass('has-error');
        }else if(Nom == ''){
            $("#Nombre_proc").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Nombre_proc').closest('.form-group').addClass('has-error');
        }else{
            $("#N_traslado").find('.text-danger').remove();
            $("#Cod").find('.text-danger').remove();
            $("#Cod").closest('.form-group').addClass('has-success');
            $("#Cantidad").find('.text-danger').remove();
            $("#Cantidad").closest('.form-group').addClass('has-success');
            $("#Precio_compra").find('.text-danger').remove();
            $("#Precio_compra").closest('.form-group').addClass('has-success');
            $("#Precio_Venta").find('.text-danger').remove();
            $("#Precio_Venta").closest('.form-group').addClass('has-success');
            $("#Descuento").find('.text-danger').remove();
            $("#Descuento").closest('.form-group').addClass('has-success');
            $("#Nombre_proc").find('.text-danger').remove();
            $("#Nombre_proc").closest('.form-group').addClass('has-success');
            $.ajax({
                url: '../admin/addtraslados.php',
                type: 'POST',
                dataType: 'html',
                data: {n_traslados:N_tras,proveedor:Proveedor,can:Can, pre_c:Pre_c, pre_v:Pre_v, cod:Cod, des:Des, nom:Nom,sucursal:suc },
            })
            .done(function(data) {
                $('#mostrar-entradas').html(data);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                document.getElementById('Cod').value = '';
                document.getElementById('Cantidad').value = '';
                document.getElementById('Precio_compra').value = '';
                document.getElementById('Nombre_proc').value = '';
                document.getElementById('Descuento').value = '';
                document.getElementById('Precio_Venta').value = '';
                console.log("complete");
            });
        }
    });

    $(".aTrasladosSal").click(function(event) {
        Cod = $('#Cod-s').val(),
        suc = $('#Sucursal').val(),
        Can = $('#Cantidad-s').val(),
        Des = $('#Descripcion-s').val();
        if (Cod == '') {
            $("#Cod-s").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Cod-s').closest('.form-group').addClass('has-error');
        }else if(Can == ''){
            $("#Cantidad-s").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Cantidad-s').closest('.form-group').addClass('has-error');
        }else if(Des == ''){
            $("#Descripcion-s").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Descripcion-s').closest('.form-group').addClass('has-error');
        }else{
            $("#Cod-s").find('.text-danger').remove();
            $("#Cod-s").closest('.form-group').addClass('has-success');
            $("#Cantidad-s").find('.text-danger').remove();
            $("#Cantidad-s").closest('.form-group').addClass('has-success');
            $("#Descripcion-s").find('.text-danger').remove();
            $("#Descripcion-s").closest('.form-group').addClass('has-success');
            $.ajax({
                url: '../admin/addtrasladossalidas.php',
                type: 'POST',
                dataType: 'html',
                data: {can:Can, cod:Cod, des:Des,sucursal:suc},
            })
            .done(function(data) {
                $('#mostrar-salidas').html(data);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                document.getElementById('Cod-s').value = '';
                document.getElementById('Cantidad-s').value = '';
                document.getElementById('Descripcion-s').value = '';
                document.getElementById('Nombre_proc').value = '';
                document.getElementById('Precio_compra').value = '';
                document.getElementById('Precio_Venta').value = '';
                console.log("complete");
            });
        }
    });
});
var auto = 0;
function mostrar_precio() {
    if (auto == 0) {
        $('.mostrar_precio').removeAttr('style');
        auto = 1;
    } else {
        $('.mostrar_precio').attr('style', 'display: none');
        auto = 0;
    }
}