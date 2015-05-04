<!DOCTYPE html>

<?php
require './models/Model.php';

$model = new Model();
$cursor = $model->getUsuarios();
$count = 0;

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mongo PHP</title>
        <link type="text/css" href="resources/css/style.css">
        <script src="resources/js/jquery-1.11.2.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {        
                
            });
            var sexo = 'm';
            
            function setSexo(sex){
                sexo =sex;
            }
            
            function cleanUserAdd(){
                $('#nombre').val('');
                $('#apellido').val('');
                $('#edad').val('');
                $('#profesion').val('');
            }
            
            function confirmRemove(id){
                
                var responseConfirm = confirm('Esta seguro de eliminar el registro '+id+' ?');
                
                if(responseConfirm === true){
                    removeUser(id);
                }else{
                    alert('Accion cancelada.');
                }
                
            }
            
            function removeUser(id){
                
                var url = 'ajax.php';
                
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: 'html',
                    data: {type:'remove_user', identificacion:id},
                    beforeSend: function () {
                        
                    },
                    success: function (ret) {
                        
                        if(ret === 'ok'){              
                            alert('registro eliminado');
                            location.href = 'index.php';
                        }else{
                            alert('ha ocurrido un error');
                        }
                        
                    },
                    error: function(){
                        
                    }
                });
                
            }
            
            function addUser(){
                
                var url = 'ajax.php';
                
                var identificacion = $('#identificacion').val();
                var nombre = $('#nombre').val();
                var apellido = $('#apellido').val();
                var edad = $('#edad').val();
                var profesion = $('#profesion').val();
                
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: 'html',
                    data: {type:'add_user', identificacion:identificacion, nombre:nombre, apellido:apellido, edad: edad, profesion:profesion, sexo:sexo},
                    beforeSend: function () {
                        
                    },
                    success: function (ret) {
                        
                        if(ret === 'ok'){              
                            cleanUserAdd();
                            alert('registro agregado');
                            location.href = 'index.php';
                        }else{
                            alert('ha ocurrido un error');
                        }
                        
                    },
                    error: function(){
                        
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
                        <li class="active" role="presentation"><a href="index.php">Inicio</a></li>
                        <li role="presentation"><a href="search.php">Buscar</a></li>
                        <li role="presentation"><a href="about.php">Acerca de</a></li>
                    </ul>
                </nav>
                <h3 class="text-muted">PHP con MongoDb</h3>
            </div>
            <div id="add" class="row col-md-7">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <label>Identificacion</label>
                            </td>
                            <td>
                                <input type="text" value="" id="identificacion" name="identificacion">
                            </td>
                            <td>
                                <label>Sexo</label>
                            </td>
                            <td>
                                <div class="radio">
                                    <label for="sexo_m">
                                        <input type="radio" value="M" name="sexo" id="sexo_m" checked onclick="setSexo('m');">
                                        M
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="sexo_f">
                                        <input type="radio" value="F" name="sexo" id="sexo_f" onclick="setSexo('f');">
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
                                <input type="text" value="" id="nombre" name="nombre">
                            </td>
                            <td>
                                <label>Apellido</label>
                            </td>
                            <td>
                                <input type="text" value="" id="apellido" name="apellido">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Edad</label>
                            </td>
                            <td>
                                <input type="text" value="" id="edad" name="edad">
                            </td>
                            <td>
                                <label>Profesion</label>
                            </td>
                            <td>
                                <input type="text" value="" id="profesion" name="profesion">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <input type="button" value="agregar" class="btn btn-default" onclick="addUser();">
                                <input type="button" value="limpiar" class="btn btn-default" onclick="cleanUserAdd();">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row col-md-5">
                
            </div>
            <div id="main" class="row col-md-12">
                <table class="table table-bordered table-hover">
                    <caption>Listado de usuarios</caption>
                    <thead>
                        <tr>
                            <th>
                                &nbsp;
                            </th>
                            <th>
                                Identificacion
                            </th>
                            <th>
                                Sexo
                            </th>
                            <th>
                                Nombre
                            </th>
                            <th>
                                Apellido
                            </th>
                            <th>
                                Edad
                            </th>
                            <th>
                                Profesion
                            </th>
                            <th colspan="2">
                                acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($cursor as $item) {
                            $count++;
                            ?>
                            <tr>
                                <td>
                                    <?php print $count; ?>
                                </td>
                                <td>
                                    <?php print $item['identificacion']; ?>
                                </td>
                                <td>
                                    <?php print (($item['sexo'] == 'm')?'Masculino':'Femenino'); ?>
                                </td>
                                <td>
                                    <?php print $item['nombre']; ?>
                                </td>
                                <td>
                                    <?php print $item['apellido']; ?>
                                </td>
                                <td>
                                    <?php print $item['edad']; ?>
                                </td>
                                <td>
                                    <?php print $item['profesion']; ?>
                                </td>
                                <td>
                                    <a href="edit.php?identificacion=<?php print $item['identificacion']; ?>">editar</a>
                                </td>
                                <td>
                                    <a href="#" onclick="confirmRemove('<?php print $item['identificacion']; ?>');">borrar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </body>
</html>
