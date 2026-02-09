<?php
// Este archivo decide qué controlador y acción cargar según el parámetro 'vista' en la URL.
$vista = $_GET['view'] ?? 'inicio';

switch ($vista) {

    case 'inicio':
        require "../app/controladores/IndexControlador.php";
        (new IndexControlador())->inicio();
        break;

    case 'login':
        require "../app/controladores/LoginControlador.php";
        $ctrl = new LoginControlador();
        ($_SERVER['REQUEST_METHOD'] === 'POST')
            ? $ctrl->procesar()
            : $ctrl->mostrar();
        break;

    case 'logout':
        require "../app/controladores/LogoutControlador.php";
        new LogoutControlador(); 
        break;


    case 'registro':
        require "../app/controladores/RegistroControlador.php";
        $ctrl = new RegistroControlador();
        ($_SERVER['REQUEST_METHOD'] === 'POST')
            ? $ctrl->procesar()
            : $ctrl->mostrar();
        break;

    case 'ranking':
        require "../app/controladores/RankingControlador.php";
        (new RankingControlador())->mostrar();
        break;

    case 'resultado':
        require "../app/controladores/ResultadoControlador.php";
        (new ResultadoControlador())->mostrar();
        break;

    case 'test':
        require "../app/controladores/TestControlador.php";
        (new TestControlador())->mostrar();
        break;

    
    case 'ajax_guardar':
        require "../app/controladores/ResultadoControlador.php";
        (new ResultadoControlador())->guardarAjax();
        break;

    default:
        echo "Ruta no encontrada";
}
