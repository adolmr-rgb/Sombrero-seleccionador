<?php
require __DIR__ . '/../../config/conexion.php';
require __DIR__ . '/../../app/modelos/ResultadoModelo.php';

class ResultadoControlador {

    // Aquí simplemente procesamos las respuestas del test, contamos puntos y guardamos la casa ganadora.
    public function guardarAjax() {

        header("Content-Type: application/json");

        if (!isset($_SESSION['user'])) {
            echo json_encode(['ok' => false, 'msg' => 'Sesión no iniciada']);
            return;
        }

        if (!isset($_POST['respuestas']) || empty($_POST['respuestas'])) {
            echo json_encode(['ok' => false, 'msg' => 'No llegaron respuestas']);
            return;
        }

        $respuestas = $_POST['respuestas'];
        $userId     = $_SESSION['user']['id'];

        // Contar votos por casa
        $conteo = [];
        foreach ($respuestas as $casaId) {
            if (!isset($conteo[$casaId])) $conteo[$casaId] = 0;
            $conteo[$casaId]++;
        }

        // Elegir casa = la que más votos tiene
        $casaGanadora = array_search(max($conteo), $conteo);

        // Guardar en la base de datos
        $modelo = new ResultadoModelo();
        global $pdo;

        $existe = $modelo->obtenerResultadoUsuario($pdo, $userId);

        if ($existe) {
            $ok = $modelo->actualizarResultado($pdo, $userId, $casaGanadora);
        } else {
            $ok = $modelo->insertarResultado($pdo, $userId, $casaGanadora);
        }

        echo json_encode([
            'ok' => $ok,
            'casa' => $casaGanadora
        ]);
    }


    // Esta parte muestra el resultado del test y permite cambiar de casa si el usuario lo pide.
    public function mostrar() {

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?view=login');
            exit;
        }

        global $pdo;

        $modelo = new ResultadoModelo();
        $idUsuario = $_SESSION['user']['id'];
        $mensaje = "";

        // Si el usuario cambia manualmente de casa
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['elegir_casa'])) {

            $nuevaCasa = intval($_POST['elegir_casa']);

            $existe = $modelo->obtenerResultadoUsuario($pdo, $idUsuario);

            if ($existe) {
                $modelo->actualizarResultado($pdo, $idUsuario, $nuevaCasa);
            } else {
                $modelo->insertarResultado($pdo, $idUsuario, $nuevaCasa);
            }

            // Guardar mensaje mágico temporal
            $_SESSION['mensaje'] = $nuevaCasa;

            // Redirección CORRECTA
            header("Location: index.php?view=resultado");
            exit;
        }

        //Obtener el último resultado del usuario
        $res = $modelo->obtenerResultadoUsuario($pdo, $idUsuario);

        $nombreCasa = $res['nombre_casa'] ?? 'Desconocida';
        $descripcion = $res['descripcion'] ?? 'Una casa misteriosa...';
        $idCasa = $res['id_casa'] ?? 0;

        // Colores de fondo según la casa
        $fondos = [
            1 => '#7b1113',  // Gryffindor
            2 => '#0b3d0b',  // Slytherin
            3 => '#1a237e',  // Ravenclaw
            4 => '#b8860b',  // Hufflepuff
            0 => '#3f2b6a'   // Default
        ];
        $colorFondo = $fondos[$idCasa] ?? '#3f2b6a';


        
        //Mensaje mágico si ha cambiado de casa
        
        if (isset($_SESSION['mensaje'])) {

            $idMensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);

            $nombres = [
                1 => 'Gryffindor',
                2 => 'Slytherin',
                3 => 'Ravenclaw',
                4 => 'Hufflepuff'
            ];
            $colores = [
                1 => '#ff3333',
                2 => '#00cc66',
                3 => '#3399ff',
                4 => '#ffcc33'
            ];

            $nombreNuevo = $nombres[$idMensaje] ?? 'Desconocida';
            $colorNuevo = $colores[$idMensaje] ?? '#c69c2d';

            $mensaje = "
                <div class='mensaje-magia' style='border-left:6px solid {$colorNuevo};'>
                    <span style='color:black; font-weight:bold;'>
                        El Sombrero ha reconsiderado... ¡Ahora perteneces a {$nombreNuevo}!
                    </span>
                </div>
            ";
        }

        // Cargar vista
        require "../app/vistas/resultado.php";
    }
}
