var mostrar_p = false;
var mos = 1;
document.onkeydown=function(e){
    /*console.log(e.which);*/
    if(e.which == 17) mostrar_p=true;
    if(e.which == 80 && mostrar_p == true) {
        mos = 1;
        mostrar_p = false;
        shCont();
        return false;
    }
    /*ESC*/
    if (e.which==27) {
        $('#Modal_fac').hide();
        $('#Modal_cliente').hide();
        $('#Modal_mecanico').hide();
        $('#Modal_diferencia').hide();
        $('#myModal').hide();
        $('#Modal_reportes').hide();
    }
}
function agregar_p(dato,pos,tipo) {
     $.ajax({
            url: "addSSpedido.php",
            type : 'post',
            dataType: 'html',
            data: {
                Dato: dato,
                Tipo: tipo,
                Pos: pos
            },
        })
        .done(function(data) {
            console.log(data);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            $('#img').html("");
        });   
}
function add_facturar_g(input){
    input.removeAttr('onclick');
    input.attr('disabled', 'disabled');
    var formData = new FormData(document.getElementById("add_facturar_g"));
    $.ajax({
        url: "factura.php",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(res) {
        $('#add-facturar-messages').html(res);
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
        setTimeout(location.href='view_producto.php', 5000);
    });
};
$(function(event){
    $("#form_edt_pro").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("form_edt_pro"));
        $.ajax({
            url: "editar_productos.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(res) {
            $('#edit-product-messages').html(res);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    });
    $(".addclientes").click(function(event) {
        var tipo = 1;
        var Nombre = $("#Nombre-cl").val();
        var Nit = $("#Nit").val();
        var Nrc = $("#Nrc").val();
        var Direccion = $("#Direccion").val();
        var Telefono = $("#Telefono").val();
        if (Nombre == '') {
            $("#Nombre-cl").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Nombre-cl').closest('.form-group').addClass('has-error');
        }else if(Nit == ''){
            $("#Nit").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Nit').closest('.form-group').addClass('has-error');
        }else if(Nrc == ''){
            $("#Nrc").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Nrc').closest('.form-group').addClass('has-error');
        }else if(Direccion == ''){
            $("#Direccion").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Direccion').closest('.form-group').addClass('has-error');
        }else if(Telefono == ''){
            $("#Telefono").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Telefono').closest('.form-group').addClass('has-error');
        }else{
            $("#Nombre-cl").find('.text-danger').remove();
            $("#Nombre-cl").closest('.form-group').addClass('has-success');
            $("#Nit").find('.text-danger').remove();
            $("#Nit").closest('.form-group').addClass('has-success');
            $("#Nrc").find('.text-danger').remove();
            $("#Nrc").closest('.form-group').addClass('has-success');
            $("#Direccion").find('.text-danger').remove();
            $("#Direccion").closest('.form-group').addClass('has-success');
            $("#Telefono").find('.text-danger').remove();
            $("#Telefono").closest('.form-group').addClass('has-success');
            $.ajax({
                    url: "agregar_cm.php",
                    type : 'post',
                    dataType: 'html',
                    data: {
                        Nombre: Nombre,
                        Nit: Nit,
                        Nrc: Nrc,
                        Direccion: Direccion,
                        Telefono: Telefono,
                        tipo: tipo
                    },
                })
                .done(function(data) {
                    $('#add-product-messages').html(data);
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    $('#img').html("");
                });
        }
    });
    $(".addmecanicos").click(function(event) {
        var tipo = 2;
        var Nombre = $("#Nombre-m").val();
        var Nit = $("#Nit-m").val();
        var Direccion = $("#Direccion-m").val();
        var Telefono = $("#Telefono-m").val();
        var Comicion = $("#Comicion-m").val();
        if (Nombre == '') {
            $("#Nombre-m").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Nombre-m').closest('.form-group').addClass('has-error');
        }else if(Nit == ''){
            $("#Nit-m").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Nit-m').closest('.form-group').addClass('has-error');
        }else if(Direccion == ''){
            $("#Direccion-m").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Direccion-m').closest('.form-group').addClass('has-error');
        }else if(Telefono == ''){
            $("#Telefono-m").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Telefono-m').closest('.form-group').addClass('has-error');
        }else if(Comicion == ''){
            $("#Comicion-m").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#Comicion-m').closest('.form-group').addClass('has-error');
        }else{
            $("#Nombre-m").find('.text-danger').remove();
            $("#Nombre-m").closest('.form-group').addClass('has-success');
            $("#Nit-m").find('.text-danger').remove();
            $("#Nit-m").closest('.form-group').addClass('has-success');
            $("#Direccion-m").find('.text-danger').remove();
            $("#Direccion-m").closest('.form-group').addClass('has-success');
            $("#Telefono-m").find('.text-danger').remove();
            $("#Telefono-m").closest('.form-group').addClass('has-success');
            $("#Comicion-m").find('.text-danger').remove();
            $("#Comicion-m").closest('.form-group').addClass('has-success');
            $.ajax({
                    url: "agregar_cm.php",
                    type : 'post',
                    dataType: 'html',
                    data: {
                        Nombre: Nombre,
                        Nit: Nit,
                        Direccion: Direccion,
                        Telefono: Telefono,
                        Comicion: Comicion,
                        tipo: tipo
                    },
                })
                .done(function(data) {
                    $('#add-mecanico-messages').html(data);
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    $('#img').html("");
                });
        }
    });
    //funciones de entradas y salidas
    $(".aEntrada").click(function(event) {
        var N_fact = $('#N_factura').val(),
        Proveedor = $('#Proveedor').val(),
        Cod = $('#Cod').val(),
        Can = $('#Cantidad').val() * 1,
        Pre_c = $('#Precio_compra').val(),
        Pre_v = $('#Precio_Venta').val(),
        Des = $('#Descuento').val(),
        Nom = $('#Nombre_proc').val();
        console.log(Can);
        if (N_fact == '') {
            $("#N_factura").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#N_factura').closest('.form-group').addClass('has-error');
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
            $("#N_fact").find('.text-danger').remove();
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
                url: '../admin/addentradas.php',
                type: 'POST',
                dataType: 'html',
                data: {n_factura:N_fact,proveedor:Proveedor,can:Can, pre_c:Pre_c, pre_v:Pre_v, cod:Cod, des:Des, nom:Nom },
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

    $(".aSalida").click(function(event) {
        Cod = $('#Cod-s').val(),
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
                url: '../admin/addsalidas.php',
                type: 'POST',
                dataType: 'html',
                data: {can:Can, cod:Cod, des:Des},
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

function eliminar_salida(pos) {
    $.ajax({
            url: '../admin/eliminar_salida.php',
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

function eliminar_entrada(pos,tipo) {
    if (tipo == 1) {
        $('#N_factura').removeAttr('disabled');
        $('#N_factura').val('');
        $.ajax({
                url: '../admin/eliminar_entrada.php',
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
                url: '../admin/eliminar_entrada.php',
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

function cambio(dato,total) {
    var cam = dato - total;
    $('#cambios').html(': $'+cam);
}

function descuento(dato,Tipo_fac) {
    $.ajax({
        url: 'descuento.php',
        async:true,
        dataType:"html",
        type: 'POST',
        data: {tipo: 0, dato: dato, Tipo_fac: Tipo_fac},
    })
    .done(function(data) {
        console.log("success");
        document.getElementById('descuento').innerHTML = data;
        $.ajax({
            url: 'descuento.php',
            async:true,
            dataType:"html",
            type: 'POST',
            data: {tipo: 1, dato: dato, Tipo_fac: Tipo_fac},
        })
        .done(function(data) {
            console.log("success");
            document.getElementById('con-cobrar').innerHTML = data;
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });

}
function data_table() {
    $('#tabla_datos').DataTable( {
        "language": {
            "lengthMenu": "Mostrar _MENU_ Registros por pagina",
            "zeroRecords": "No hay resultados - lo siento",
            "info": "Mostrando _PAGE_ de _PAGES_ paginas",
            "infoEmpty": "No hay resultados - lo siento",
            "sSearch": "Buscar: ",
            "infoFiltered": "( En _MAX_ Registros)"
        }
    } );
}
function Buscar_r(Id) {
    var Tipo = 1;
    $.ajax({
        url: 'reporte_entradas.php',
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
function Buscar_salidas(Id) {
    var Tipo = 1;
    $.ajax({
        url: 'reporte_salidas.php',
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
function modal(Id){
    $.ajax({
        url: 'contenido.php',
        async:true,
        dataType:"html",
        type: 'POST',
        data: {id: Id },
    })
    .done(function(data) {
        console.log("success");
        document.getElementById('contenido-modal').innerHTML = data;
        $("#myModal").show();
        addPedido();

    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
}
function cantidad(can,id){
    $.ajax({
            url: '../admin/addSSpedido.php',
            type: 'POST',
            dataType: 'html',
            data: {Id:id, Can:can},
        })
        .done(function(data) {
            $("#dp").html(data);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            $('#myModal').hide();
        });
}
function imprimir() {
        var contenido= document.getElementById('imp_inventario').innerHTML;
        var contenidoOriginal= document.body.innerHTML;
        document.body.innerHTML = contenido;
        window.print();
        document.body.innerHTML = contenidoOriginal;
    }
function inventario(Dato,Tipo){
    $.ajax({
        url: 'buscar_inventario.php',
        async:true,
        dataType:"html",
        type: 'POST',
        data: {dato: Dato, tipo: Tipo },
    })
    .done(function(data) {
        console.log("success");
        $('#imp_inventario').html(data);
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
}
function inventario_cost(Dato,Tipo){
    $.ajax({
        url: 'buscar_inventario_cost.php',
        async:true,
        dataType:"html",
        type: 'POST',
        data: {dato: Dato, tipo: Tipo },
    })
    .done(function(data) {
        console.log("success");
        $('#imp_inventario').html(data);
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
}
function modal_fac() {
    $("#Modal_fac").show();
}
function validar_campos(e) {
    tecla = (document.all) ? e.KeyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla = 8) {
        return true;
    }
    //patron de entrada, en este caso solo acepta numeros
    patron = /[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
function clean(dato) {
    if (dato==1) {
        $('#cd_cliente').val('');
        $('#nrc_cliente').val('');
        $('#Nombre_cl').val('');
        $('#operacion').val(2);
        $('#Id_cliente').val(0);
    }else if(dato==2){
        $('#cd_mecanico').val('');
        $('#Nombre_me').val('');
        $('#nit_mecanico').val('');
        $('#Id_mecanico').val(0);
    }
}
function busclientes() {
    var tipo = 1;
    var cd_cliente = $('#cd_cliente').val();
    var nrc_cliente = $('#nrc_cliente').val();
    $.ajax({
        url: "buscar.php",
        type : 'post',
        dataType: 'html',
        data: {
            cd_cliente: cd_cliente,
            nrc_cliente: nrc_cliente,
            tipo: tipo
        },
    })
    .done(function(data) {
        document.getElementById('con-cliente').innerHTML = data;
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        $('#img').html("");
    });
};
function busmecanico() {
    var tipo = 2;
    var cd_mecanico =  $('#cd_mecanico').val();
    var nit_mecanico =  $('#nit_mecanico').val();
    $.ajax({
        url: "buscar.php",
        type : 'post',
        dataType: 'html',
        data: {
            cd_mecanico: cd_mecanico,
            nit_mecanico: nit_mecanico,
            tipo: tipo
        },
    })
    .done(function(data) {
        document.getElementById('con-mecanico').innerHTML = data;
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        $('#img').html("");
    });
};
function busvendedor(cod) {
    var tipo = 3;
    $.ajax({
        url: "buscar.php",
        type : 'post',
        dataType: 'html',
        data: {
            cod: cod,
            tipo: tipo
        },
    })
    .done(function(data) {
        document.getElementById('con-vendedor').innerHTML = data;
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        $('#img').html("");
    });
};
function anular_facura(dato,tipo) {
    if (tipo==2) {
        consultar_series = $('#consultar_series').val();
        N_fac = $('#N_fac').val();
        Descripcion = $('#Descripcion').val();
        Id_factura = $('#Id_factura').val();
        dato_tipo = $('#dato_tipo').val();
        if(consultar_series == '') {
            $("#consultar_series").after('<p class="text-danger"> Este campo es obligatorio</p>');
            $('#consultar_series').closest('.form-group').addClass('has-error');
            return false;
        }else if (N_fac == '') {
            $("#N_fac").after('<p class="text-danger">Este campo es obligatorio</p>');
            $('#N_fac').closest('.form-group').addClass('has-error');
            return false;
        }else if(Descripcion == '') {
            $("#Descripcion").after('<p class="text-danger"> Este campo es obligatorio</p>');
            $('#Descripcion').closest('.form-group').addClass('has-error');
            return false;
        }else{
            $("#Descripcion").find('.text-danger').remove();
            $("#Descripcion").closest('.form-group').addClass('has-success');
            $("#N_fac").find('.text-danger').remove();
            $("#N_fac").closest('.form-group').addClass('has-success');
            $.ajax({
                url: 'anular_facura.php',
                async:true,
                dataType:"html",
                type: 'POST',
                data: {tipo: tipo, dato: dato_tipo, consultar_series: consultar_series, N_fac: N_fac, Descripcion: Descripcion, Id_factura: Id_factura},
            })
            .done(function(data) {
                $('#datos_anular_factura').html(data);
            }); 
        }
    }else if(tipo==1){
        $.ajax({
            url: 'anular_facura.php',
            async:true,
            dataType:"html",
            type: 'POST',
            data: {tipo: tipo, dato: dato},
        })
        .done(function(data) {
            $('#datos_anular_factura').html(data);
        });
    }                       
}