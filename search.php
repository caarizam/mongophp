<!DOCTYPE html>

<?php 

require './models/Model.php';

$count = 0;
$model = new Model();

$search = ((isset($_POST['search']))?$_POST['search']:null);

$cursor = array();

if($search!=null && $search != ''){
    $cursor = $model->findUserByNombreOrApellido($search);
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Buscar</title>
        <link type="text/css" href="resources/css/style.css">
        <script src="resources/js/jquery-1.11.2.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation"><a href="index.php">Inicio</a></li>
                        <li class="active" role="presentation"><a href="search.php">Buscar</a></li>
                        <li role="presentation"><a href="about.php">Acerca de</a></li>
                    </ul>
                </nav>
                <h3 class="text-muted">PHP con MongoDb</h3>
            </div>
            <div class="row">
                <form method="post" action="search.php">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="buscar ..." value="<?php print $search; ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Buscar</button>
                        </span>
                    </div>
                </form>
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
