<?php
class PreguntaModelo {
// Aquí sacamos todas las preguntas del test para mostrarlas al usuario.
    public function obtenerPreguntas($pdo) {
        return $pdo->query("SELECT * FROM preguntas ORDER BY id_pregunta")->fetchAll();
    }
}
