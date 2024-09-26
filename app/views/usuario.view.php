<?php

class UsuarioView {

    public function showLogin() {
        require_once 'templates/header.php';
            ?>
            <h2>Login</h2>
           <form method="post" action="autenticar">
               <input type="text" name="email" placeholder="Ingrese su email..."/>
               <input type="password" name="password" placeholder="Ingrese su password..."/>
               <button>Login</button>
            </form>
            <a href="registrar">Registrar</a>
        </body>
        </html>
        <?php
    }
    
    public function showRegistrar() {
        require_once 'templates/header.php';
            ?>
            <h2>Registro</h2>
            <form method="post" action="agregar">
                <input type="text" name="email" placeholder="Ingrese su email..."/>
                <input type="password" name="password" placeholder="Ingrese su password..."/>
                <button>Crear cuenta</button>
            </form>
        </body>
        </html>
        <?php
    }
}