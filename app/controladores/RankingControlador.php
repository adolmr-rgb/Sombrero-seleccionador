<?php

require __DIR__ . '/../../config/conexion.php';
require __DIR__ . '/../../app/modelos/ResultadoModelo.php';

class RankingControlador {

    public function mostrar() {

        global $pdo;

        $modelo = new ResultadoModelo();

        // Aquí sacamos los resultados de todos y contamos cuántos puntos tiene cada casa para mostrar el ranking.
        $lista = $modelo->ultimoResultadoPorUsuario($pdo);

        // Contador por casa
        $totales = ['Gryffindor'=>0, 'Slytherin'=>0, 'Ravenclaw'=>0, 'Hufflepuff'=>0];

        foreach ($lista as $r) {
            if (isset($totales[$r['nombre_casa']])) {
                $totales[$r['nombre_casa']]++;
            }
        }

        $maxPuntos = max($totales);

        // Cargar vista
        require "../app/vistas/ranking.php";
    }
}
