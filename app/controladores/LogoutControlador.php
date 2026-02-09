<?php

class LogoutControlador {

    public function __construct() {
        // Aquí básicamente cerramos la sesión del usuario y lo mandamos de vuelta al inicio del sitio.
        $_SESSION = [];
        session_destroy();

        
        header("Location: index.php?view=inicio");
        exit;
    }
}
