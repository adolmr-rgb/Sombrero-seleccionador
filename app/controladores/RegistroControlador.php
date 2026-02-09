<?php
require __DIR__ . '/../../config/conexion.php';
require __DIR__ . '/../../app/modelos/UsuarioModelo.php';

class RegistroControlador {

    public function mostrar() {
        $error = $_SESSION['error_registro'] ?? "";
        unset($_SESSION['error_registro']);
        require "../app/vistas/registro.php";
    }

    public function procesar() {
        global $pdo;

        $nombre   = trim($_POST['usuario'] ?? ""); // seguimos usando 'usuario' en el formulario
        $password = $_POST['password'] ?? "";

        if ($nombre === "" || $password === "") {
            $_SESSION['error_registro'] = "Rellena todos los campos";
            header("Location: index.php?view=registro");
            exit;
        }

        $modelo = new UsuarioModelo();

        // Verificar si ya existe el usuario
        if ($modelo->buscarPorUsuario($pdo, $nombre)) {
            $_SESSION['error_registro'] = "El usuario ya existe";
            header("Location: index.php?view=registro");
            exit;
        }

        // Guardar usuario con contraseña encriptada
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $modelo->crear($pdo, $nombre, $hash);

        header("Location: index.php?view=login");
        exit;
    }
}


