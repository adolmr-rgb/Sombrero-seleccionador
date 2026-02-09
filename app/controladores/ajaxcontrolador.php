<?php
session_start();
require_once __DIR__ . '/../../config/conexion.php'; //Inicio sesión y cargo archivos
require_once __DIR__ . '/../../app/modelos/ResultadoModelo.php'; // Cargo el modelo de resultados

class AjaxControlador {

    public function guardarResultado() { //recibo las respuestas del test via Ajax

        header('Content-Type: application/json; charset=utf-8');

        if (!isset($_SESSION['user'])) {
            echo json_encode(['ok' => false, 'msg' => 'No autenticado']);
            return;
        }

        $userId = $_SESSION['user']['id'];
        $datos = $_POST['respuestas'] ?? null;

        if (!$datos || !is_array($datos)) {
            echo json_encode(['ok' => false, 'msg' => 'Datos inválidos']); // Si no hay sesión, mando error
            return;
        }

        // Aquí cuento cuantas respuestas corresponden a cada casa
        $contador = [1=>0, 2=>0, 3=>0, 4=>0];
        foreach ($datos as $val) {
            $casa = intval($val);
            if (isset($contador[$casa])) $contador[$casa]++;
        }

        // SeleccionarAquí determino la casa ganadora
        $casaAsignada = array_keys($contador, max($contador))[0];

        // Guardo el resultado en la base de datos
        $modelo = new ResultadoModelo();
        global $pdo;

        $existe = $modelo->obtenerResultadoUsuario($pdo, $userId);

        if ($existe) {
            $modelo->actualizarResultado($pdo, $userId, $casaAsignada);
        } else {
            $modelo->insertarResultado($pdo, $userId, $casaAsignada);
        }

        echo json_encode(['ok' => true, 'casa' => $casaAsignada]); //Envío respuesta Json al Frontend
    }
}
