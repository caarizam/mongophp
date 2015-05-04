<!DOCTYPE html>

<?php
require './models/Model.php';
$model = new Model();

$identificacion = $_GET['identificacion'];

$usuario = $model->findUserByIdentificacion($identificacion);


?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar usuario</title>
        <link type="text/css" href="resources/css/style.css">
        <script src="resources/js/jquery-1.11.2.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script>

            var sexo = '<?php print $usuario['sexo']; ?>';

            function setSexo(sex) {
                sexo = sex;
            }

            function addUser() {

                var url = 'ajax.php';                
                
                var identificacion = '<?php print $usuario['identificacion']; ?>';
                var nombre = $('#nombre').val();
                var apellido = $('#apellido').val();
                var edad = $('#edad').val();
                var profesion = $('#profesion').val();

                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: 'html',
                    data: {type: 'edit_user', identificacion: identificacion, nombre: nombre, apellido: apellido, edad: edad, profesion: profesion, sexo: sexo},
                    beforeSend: function () {

                    },
                    success: function (ret) {

                        if (ret === 'ok') {                            
                            alert('Registro actualizado.');                          
                        } else {
                            alert('Ha ocurrido un error al actualizar.');                            
                        }

                    },
                    error: function () {

                    }
                });

            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation"><a href="index.php">Inicio</a></li>
                        <li role="presentation"><a href="search.php">Buscar</a></li>
                        <li role="presentation"><a href="about.php">Acerca de</a></li>
                    </ul>
                </nav>
                <h3 class="text-muted">PHP con MongoDb</h3>
            </div>
            <div id="add" class="row col-md-7">
                <table class="table table-bordered">
                    <caption>Editar informacion</caption>
                    <tbody>
                        <tr>
                            <td>
                                <label>Identificacion</label>
                            </td>
                            <td>
                                <input type="text" value="<?php print $usuario['identificacion']; ?>" id="identificacion" name="identificacion" readonly>
                            </td>
                            <td>
                                <label>Sexo</label>
                            </td>
                            <td>
                                <div class="radio">
                                    <label for="sexo_m">
                                        <input type="radio" value="M" name="sexo" id="sexo_m" onclick="setSexo('m');" <?php print (($usuario['sexo'] == 'm') ? 'checked' : ''); ?>>
                                        M
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="sexo_f">
                                        <input type="radio" value="F" name="sexo" id="sexo_f" onclick="setSexo('f');" <?php print (($usuario['sexo'] == 'f') ? 'checked' : ''); ?>>
                                        F
                                    </label>
                                </div>                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Nombre</label>
                            </td>
                            <td>
                                <input type="text" value="<?php print $usuario['nombre']; ?>" id="nombre" name="nombre">
                            </td>
                            <td>
                                <label>Apellido</label>
                            </td>
                            <td>
                                <input type="text" value="<?php print $usuario['apellido']; ?>" id="apellido" name="apellido">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Edad</label>
                            </td>
                            <td>
                                <input type="text" value="<?php print $usuario['edad']; ?>" id="edad" name="edad">
                            </td>
                            <td>
                                <label>Profesion</label>
                            </td>
                            <td>
                                <input type="text" value="<?php print $usuario['profesion']; ?>" id="profesion" name="profesion">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <input type="button" value="actualizar" class="btn btn-default" onclick="addUser();">
                                <input type="button" value="cancelar" class="btn btn-default" onclick="history.go(-1);">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row col-md-5">

            </div>
            
        </div>        
    </body>
</html>
