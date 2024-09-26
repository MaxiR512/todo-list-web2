<?php

class Model {

    //Crea la conexión a la DB
    protected function crearConexion () {

        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'tareas';
    
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
        } catch (\Throwable $th) {
            die($th);
        }

        return $pdo;
    }


}