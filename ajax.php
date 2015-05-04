<?php

require './models/Model.php';
$model = new Model();

$type = $_GET['type'];

if($type == 'add_user'){
    
    $identificacion = $_GET['identificacion'];
    $sexo = $_GET['sexo'];
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $edad = $_GET['edad'];
    $profesion = $_GET['profesion'];
    
    $document = array(
        'identificacion'=>$identificacion,
        'sexo'=>$sexo,
        'nombre'=>$nombre,
        'apellido'=>$apellido,
        'edad'=>$edad,
        'profesion'=>$profesion
    );
    
    $flag = $model->insertData($document);
    
    if($flag == true){
        print 'ok';
    }else{
        print 'fail';
    }
}elseif($type == 'remove_user'){
    
    $identificacion = $_GET['identificacion'];
    $flag = $model->removeByIdentification($identificacion);
    
    if($flag == true){
        print 'ok';
    }else{
        print 'fail';
    }
    
}elseif ($type == 'edit_user') {
    
    $identificacion = $_GET['identificacion'];
    $sexo = $_GET['sexo'];
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $edad = $_GET['edad'];
    $profesion = $_GET['profesion'];
    
    $documento = array(
        'identificacion'=>$identificacion,
        'sexo'=>$sexo,
        'nombre'=>$nombre,
        'apellido'=>$apellido,
        'edad'=>$edad,
        'profesion'=>$profesion
    );
    
    $flag = $model->updateUserById($identificacion, $documento);
    
    if($flag == true){
        print 'ok';
    }else{
        print 'fail';
    }
    
}

