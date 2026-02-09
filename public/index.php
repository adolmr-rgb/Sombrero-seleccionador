<?php
session_start();
require_once "../config/conexion.php";
require_once "../routes/web.php";
// Este es el punto de entrada: iniciamos sesión, conectamos a la DB y cargamos las rutas del Modelo vista controlador