<?php

require_once 'app/models/usuario.model.php';
require_once 'app/views/usuario.view.php';


class UsuarioController {

    private $model;
    private $view;

    public function __construct(){
        $this->model = new UsuarioModel();
        $this->view = new UsuarioView();
    }

    public function login () {
        $this->view->showLogin();
    }

    public function logout () {
        session_start();
        session_destroy();

        header('Location: '.'login');
    }    

    public function registrar () {
        $this->view->showRegistrar();
    }    

    public function agregar () {
        $userEmail = $_POST['email'];
        $userPassword = $_POST['password'];
    
        $hash = password_hash($userPassword, PASSWORD_DEFAULT);

        $user = $this->model->createUsuario($userEmail, $hash, 'N');
        header('Location: '.'login');
    }     

    public function autenticar () {

        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        $user = $this->model->getUsuario($email);

        //Si el usuario existe y las contraseñas coinciden
        if($user && password_verify($password,($user->password))){
            session_start();

            $_SESSION["logueado"] = true;
            $_SESSION["usuario"] = $email;
            $_SESSION["administrador"] = $user->administrador;
    
            header('Location: '.'home');
        }else{
            header('Location: '.'/login');
        }

        
        //$this->view->showLogin();
    }    

    //Función de crear una nueva tarea
    public function insertar(){
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
        //Enviar el id al modelo
        $this->model->deleteTask($id);
        //Redireccionarme
        header('Location: ' . BASE_URL . 'home');
    }

    //Muestra form para editar tarea
    public function editarTarea($id){
        //Pedirle la tarea con ese id al modelo
        $tarea = $this->model->getTask($id);
        //Pasarle la tarea a la vista 
        $this->view->showEditForm($tarea);
    }

    //Modifica una tarea
    public function modificar(){
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