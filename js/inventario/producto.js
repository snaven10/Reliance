function modal_add(){
    $.ajax({
        url: 'axios/inventario/form_product.php',
        async:true,
        dataType:"html",
        type: 'POST',
    })
    .done(function(data) {
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