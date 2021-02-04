<!DOCTYPE html>
<html>
    <head>
        <link href='../css/bootstrap.min.css' rel='stylesheet'>
                <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript">
            function subir_imagen() {
                var formulario = $('#formulario').serialize();
                $.ajax({
                    url: 'subir_img.php',
                    type: 'POST',
                    data: {formulario: formulario},
                })
                .done(function(data) {
                    alert(data);
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
                
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <br>
                <div class="col-ms-12">
                    <form id="formulario">
                        <label for='file' class='img-circle' style='font-size:32pt;background:#559;color:#fff;width:80px;height:80px;padding:0.5em;'>
                        <span class='glyphicon glyphicon-plus'></span>
                        </label>
                        <input id='file' type='file' name='Ima' style='display:none;' />
                        <button onclick="subir_imagen();">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>