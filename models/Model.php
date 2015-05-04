<?php

/**
 * @author caarizam
 * Clase encargada de gestionar la conexion a una bd 
 * en Mongo.
 */
class Model {

    /**
     * Clase que permite obtener todos los registros de la coleccion
     * usuarios
     * @return type un cursor con toda la informacion
     */
    public function getUsuarios() {

        $mongo = new MongoClient();
        $bdmongo = $mongo->testing;
        $collection = $bdmongo->usuarios;

        $cursor = $collection->find();

        return $cursor;
    }

    /**
     * Metodo que permite insertar un documento en la coleccion usuarios.
     * Si se encuentra un documento con el mismo valor del campo
     * identificacion no se inserta
     * @param type $document array con la informacion del documento a insertar
     * @return boolean TRUE en caso de exito, FALSE en caso de fallo
     */
    public function insertData($document) {

        try {
            $userExist = $this->_findUserByIdentificacion($document['identificacion']);
            if (count($userExist) > 0) {
                return false;
            }

            $mongo = new MongoClient();
            $bdmongo = $mongo->testing;
            $collection = $bdmongo->usuarios;
            $collection->insert($document);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    /**
     * Metodo que permite eliminar un registro por el numero de identificacion
     * @param type $identification valor numerico del usuario 
     * @return boolean TRUE en caso de exito, FALSE en caso de fallo
     */
    public function removeByIdentification($identification) {

        try {
            $mongo = new MongoClient();
            $bdmongo = $mongo->testing;
            $collection = $bdmongo->usuarios;
            $collection->remove(array('identificacion' => $identification));
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function findUserByIdentificacion($identificacion) {
        return $this->_findUserByIdentificacion($identificacion);
    }
    
    /**
     * Metodo que permite encontrar un registro mediante el numero de identificacion
     * del usuairo
     * @param type $identificacion numero de identificacion del usuario
     * @return type mixed array con la informacion encontrada
     */
    private function _findUserByIdentificacion($identificacion) {

        try {
            $mongo = new MongoClient();
            $bdmongo = $mongo->testing;
            $collection = $bdmongo->usuarios;
            $cursor = $collection->findOne(array('identificacion' => $identificacion));
            return $cursor;
        } catch (Exception $ex) {
            return array();
        }
    }
    
    /**
     * Metodo que permite actualizar un registro de usuario mediante su identificacion
     * @param type $identificacion identificacion del usuario
     * @param type $documento informacion a actualizar
     * @return boolean TRUE en caso de exito, FALSE en caso de fallo
     */
    public function updateUserById($identificacion, $documento) {

        try {
            $mongo = new MongoClient();
            $bdmongo = $mongo->testing;
            $collection = $bdmongo->usuarios;
            $collection->update(array('identificacion' => $identificacion), $documento);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    /**
     * Metodo que permiete realizar una busquedad en los registros mediante el nombre ó el
     * apellido del usuario
     * @param type $search texto a buscar
     * @return type mixed array con la informacion encontrada
     */
    public function findUserByNombreOrApellido($search) {

        try {
            $searchNombre = array(
                "nombre" => new MongoRegex("/$search/")
            );

            $searchApellido = array(
                "apellido" => new MongoRegex("/$search/")
            );

            $mongo = new MongoClient();
            $bdmongo = $mongo->testing;
            $collection = $bdmongo->usuarios;
            $response = $collection->find(array('$or' => array($searchNombre, $searchApellido)));
            return $response;
        } catch (Exception $ex) {
            return array();
        }
    }

}
