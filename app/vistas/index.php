<?php
// Aquí mostramos la página de inicio del Sombrero Seleccionador, con enlaces a registro, login, test y ranking.
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Sombrero Seleccionador - Inicio</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> 
  <link rel="stylesheet" href="css/estilos.css">
</head>

<body class="bg-dark text-light">

<header class="py-3 bg-gradient">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0">¡Bienvenido al Sombrero Seleccionador de Adolfo!</h1>
        
        <div>
            <?php if (isset($_SESSION['user'])): ?>
                <span class="me-3">Hola, <?= htmlspecialchars($_SESSION['user']['nombre']) ?></span>
                <a href="index.php?view=logout" class="btn btn-sm btn-outline-light">Cerrar sesión</a>
            <?php else: ?>
                <a href="index.php?view=registro" class="btn btn-sm btn-outline-light me-2">Registrarse</a>
                <a href="index.php?view=login" class="btn btn-sm btn-outline-light">Iniciar sesión</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<main class="container py-4">

    <section class="row align-items-center">
        <div class="col-md-7">
            <img src="img/hogwarts.jpg" alt="Hogwarts" class="img-fluid rounded shadow">
        </div>

        <div class="col-md-5">
            <h2 class="text-gold">Descubre tu casa en Hogwarts</h2>
            <p>Un test sencillo con ranking global. Incluye animación y sonido del Sombrero pensando.</p>
            <div class="mt-3">
                <a href="index.php?view=test" class="btn btn-primary me-2">Comenzar Test</a>
                <a href="index.php?view=ranking" class="btn btn-secondary">Ver Ranking</a>
            </div>
        </div>
    </section>

    <section class="mt-4">
        <h3>¿Si fueras a Hogwarts en qué casa te pondría el Sombrero? ¡Gracias a este sencillo test lo descubrirás!</h3>
        <h3>Además verás un Ranking en tiempo real y las puntuaciones por casas. ¿Estás preparado/a?</h3>
        <p class="text-muted">Proyecto de Adolfo Martín Rodríguez</p>
    </section>

</main>

<footer class="py-3 text-center text-muted">
    Proyecto DAW - Adolfo
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
