<?php


require __DIR__ . '/../../app/modelos/PreguntaModelo.php';
require __DIR__ . '/../../app/modelos/OpcionModelo.php';

class TestControlador {

    public function mostrar() {

        // Aquí básicamente preparamos todas las preguntas y opciones del test para mostrarlas al usuario.
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?view=login");
            exit;
        }

        global $pdo;

        $preguntaModelo = new PreguntaModelo();
        $opcionModelo   = new OpcionModelo();

        // Obtener todas las preguntas (pasando $pdo) 
        $preguntas = $preguntaModelo->obtenerPreguntas($pdo);

        // Obtener opciones por pregunta (pasando $pdo)
        $opciones = [];
        foreach ($preguntas as $p) {
            $opciones[$p['id_pregunta']] = $opcionModelo->obtenerOpciones($pdo, $p['id_pregunta']);
        }

        // Cargar la vista (que utilizará $preguntas y $opciones)
        require "../app/vistas/test.php";
    }
}


