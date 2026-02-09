<?php
class OpcionModelo {

    // Aquí sacamos todas las opciones de una pregunta específica para mostrarlas en el test.
    public function obtenerOpciones($pdo, $idPregunta) {
        $stmt = $pdo->prepare("SELECT id_opcion, texto_opcion, id_casa FROM opciones WHERE id_pregunta = ?");
        $stmt->execute([$idPregunta]);
        return $stmt->fetchAll();
    }

    // Aquí obtenemos todas las opciones del test de golpe, ordenadas por pregunta.
    public function obtenerTodas($pdo) {
        $stmt = $pdo->query("SELECT id_opcion, id_pregunta, texto_opcion, id_casa FROM opciones ORDER BY id_pregunta");
        return $stmt->fetchAll();
    }
}
