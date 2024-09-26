<?php
require_once('model.php');

class TaskModel extends Model {

    
    //Función que pide a la DB todas las tareas
    public function getTareas(){
        $pdo = $this->crearConexion();

        $sql = "select * from tarea order by prioridad DESC";
        $query = $pdo->prepare($sql);
        $query->execute();
    
        $tareas = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $tareas;
    }

    //Función para crear una nueva tarea
    public function createTask($descripcion, $terminada, $prioridad){
        $pDO = $this->crearConexion();
        
        $sql = 'INSERT INTO tarea (descripcion, terminada, prioridad) 
                VALUES (?, ?, ?)';

        $query = $pDO->prepare($sql);
        try {
            $query->execute([$descripcion, $terminada, $prioridad]);
        } catch (\Throwable $th) {
            return null;
        }
    }

    //Elimina de la DB la tarea con ese id
    public function deleteTask($id){
        $pDO = $this->crearConexion();
    
        $sql = 'DELETE FROM tarea
                WHERE id = ?';

        $query = $pDO->prepare($sql);
        try {
            $query->execute([$id]);
        } catch (\Throwable $th) {
            return null;
        }
    }

    //Función que trae una tarea por id
    public function getTask($id){
        $pdo = $this->crearConexion();

        $sql = "SELECT * FROM tarea
        WHERE id = ?" ;
        $query = $pdo->prepare($sql);
        $query->execute([$id]);

        $tarea = $query->fetch(PDO::FETCH_OBJ);

        return $tarea;
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