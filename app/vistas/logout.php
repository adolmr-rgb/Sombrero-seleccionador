<?php
session_start(); //Activar sesión
session_destroy(); //Borrar todos los datos de la sesión
header('Location: index.php'); //Después de cerrar la sesión, lo mando de vuelta al inicio.
exit;
