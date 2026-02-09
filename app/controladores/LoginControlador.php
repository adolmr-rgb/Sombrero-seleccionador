<?php

require __DIR__ . '/../../app/modelos/UsuarioModelo.php';

class LoginControlador {

    public function mostrar() {
        $mensaje = "";
        require "../app/vistas/login.php";
    }

    public function procesar() {
        global $pdo;

        $modelo = new UsuarioModelo();

        $nombre = trim($_POST['nombre'] ?? '');
        $pass   = trim($_POST['password'] ?? '');

        if ($nombre === '' || $pass === '') {
            $mensaje = "Rellena todos los campos.";
            require "../app/vistas/login.php";
            return;
        }

        // Aquí buscamos al usuario en la base de datos para ver si existe y la contraseña coincide.
        $user = $modelo->buscarPorUsuario($pdo, $nombre);

        if ($user && password_verify($pass, $user['password'])) {

            // Si todo cuadra, creamos la sesión para que el usuario quede logueado.
            $_SESSION['user'] = [
                'id'     => $user['id_usuario'],
                'nombre' => $user['nombre']
            ];

            header("Location: index.php?view=inicio");
            exit;
        }

        // Si falló el login, pues avisamos que los datos están mal.
        $mensaje = "Usuario o contraseña incorrectos.";
        require "../app/vistas/login.php";
    }
}

