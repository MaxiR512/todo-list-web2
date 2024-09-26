<?php

require_once 'app/models/task.model.php';
require_once 'app/views/task.view.php';


class TaskController {

    private $model;
    private $view;

    private function checkLogin() {
        //session_start();
        if (array_key_exists("logueado", $_SESSION) && $_SESSION["logueado"]) 
        {
            return true;
        }         
        header('Location: ' . BASE_URL . 'login');
    }

    public function __construct(){
        $this->model = new TaskModel();
        $this->view = new TaskView();
    }

    public function showListTask(){
        //Pedir al modelo todas las tareas
        $tareas =  $this->model->getTareas();

        //Pasarle a la vista las tareas
        $this->view->mostrarTareas($tareas);
    }

    //Función de crear una nueva tarea
    public function insertar(){
        $this->checkLogin();

        //Obtener todos los datos del formulario
        $descripcion = $_REQUEST['descripcion'];
        $terminada = $_REQUEST['terminada'];
        $prioridad = $_REQUEST['prioridad'];

        //Pasarle al model todos los datos
        $this->model->createTask($descripcion, $terminada, $prioridad);

        //Redirección
        header('Location: ' . BASE_URL . 'home');
    }

    //Función que me va a eliminar una tarea
    public function borrar($id){
        $this->checkLogin();

        //Enviar el id al modelo
        $this->model->deleteTask($id);
        //Redireccionarme
        header('Location: ' . BASE_URL . 'home');
    }

    //Muestra form para editar tarea
    public function editarTarea($id){
        $this->checkLogin();

        //Pedirle la tarea con ese id al modelo
        $tarea = $this->model->getTask($id);
        //Pasarle la tarea a la vista 
        $this->view->showEditForm($tarea);
    }

    //Modifica una tarea
    public function modificar(){
        $this->checkLogin();

        //Tomo datos del formulario
        $id = $_REQUEST['id'];
        $descripcion = $_REQUEST['descripcion'];
        $terminada = $_REQUEST['terminada'];
        $prioridad = $_REQUEST['prioridad'];

        //Envío datos al modelo
        $this->model->updateTask($descripcion, $terminada, $prioridad, $id);
        
        //Redirecciono
        header('Location: ' . BASE_URL . 'home');
    }
}