
const tipo_factura = document.getElementById('Tipo_fac');
const forma_pago = document.getElementById('Forma_pago');
const siguiente = document.getElementById('Siguiente');
siguiente.addEventListener('click',function() {
    if (tipo_factura.value == 1 || forma_pago.value == 2) {
        let cod_cliente = document.getElementById('cd_cliente').value;
        const param = {
            cod_cliente
        };
        axios.post('axios/inventario/validaciones.php', param)
            .then(response => {
                mesag = response.data.split(',');
                swal
                ({
                    position: 'center',
                    type: mesag[0],
                    title: mesag[1]
                })
            }).catch(e => {
                console.log(e);
            });
    }
});
