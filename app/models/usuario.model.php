<?php
require_once('model.php');

class UsuarioModel extends Model {
    
    //Función que pide a la DB un usuario a partir de un email
    public function getUsuario($email){
        $pdo = $this->crearConexion();

        $sql = "select * from usuario where email = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$email]);
    
        $usuario = $query->fetch(PDO::FETCH_OBJ);
    
        return $usuario;
    }

    //Función para crear una nueva tarea
    public function createUsuario($email, $hash, $administrador){
        $pDO = $this->crearConexion();
        
        $sql = 'INSERT INTO usuario (email, password, administrador) 
                VALUES (?, ?, ?)';

        $query = $pDO->prepare($sql);
        try {
            $query->execute([$email, $hash, $administrador]);
        } catch (\Throwable $th) {
            return null;
        }
    }


    //Modifica tarea
    public function updateTask($descripcion, $terminada, $prioridad, $id){
        $pDO = $this->crearConexion();

        $sql = 'UPDATE tarea
            SET descripcion = ?, terminada = ?, prioridad = ?
            WHERE id = ?';

        $query = $pDO->prepare($sql);
        try {
            $query->execute([$descripcion, $terminada, $prioridad, $id]);
            
        } catch (\Throwable $th) {
            return null;
        }
    }
}