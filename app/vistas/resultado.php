<?php
// Aquí mostramos el resultado del Sombrero Seleccionador con la casa asignada y opción para cambiarla manualmente.

if (!isset($_SESSION['user'])) {
    header("Location: index.php?view=login");
    exit;
}

// Variables enviadas desde ResultadoControlador:
// $nombreCasa, $descripcion, $idCasa, $colorFondo, $mensaje
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Resultado del Sombrero</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilos.css">

  <style>
    .mensaje-magia {
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-weight: bold;
      animation: aparecer 1.5s ease;
      box-shadow: 0 0 10px rgba(198, 156, 45, 0.5);
    }
    @keyframes aparecer {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>

<body class="bg-dark text-light">

<header class="py-2 bg-gradient text-center">
    <h1 class="h4 mb-0">El Sombrero ha hablado</h1>
</header>

<main class="container text-center py-5"
      style="background: linear-gradient(135deg, <?= $colorFondo ?>, #000000c0);
             border-radius:15px; box-shadow:0 0 25px rgba(0,0,0,0.5);">

  <div class="bg-light text-dark p-4 rounded shadow">

    <!-- Mensaje mágico -->
    <?php if (!empty($mensaje)) echo $mensaje; ?>

    <h2 class="text-gold mb-3">La casa de <?= htmlspecialchars($nombreCasa) ?></h2>

    <img src="img/hat.png" alt="Sombrero" class="hat mb-3"><br>
    <img src="img/<?= strtolower($nombreCasa) ?>.png"
         alt="<?= htmlspecialchars($nombreCasa) ?>"
         class="escudo escudo-<?= strtolower($nombreCasa) ?> mb-3">

    <p class="lead"><?= htmlspecialchars($descripcion) ?></p>

    <!-- Elegir casa manualmente -->
    <section class="mt-3">
        <h3 class="text-black fw-bold">¿No estás de acuerdo? Elige tu casa preferida</h3>

        <form method="post" action="index.php?view=resultado"
              class="d-flex gap-2 justify-content-center align-items-center mt-2">

            <select name="elegir_casa" class="form-select" style="max-width:220px;">
                <option value="1" <?= ($idCasa == 1 ? 'selected' : '') ?>>Gryffindor</option>
                <option value="2" <?= ($idCasa == 2 ? 'selected' : '') ?>>Slytherin</option>
                <option value="3" <?= ($idCasa == 3 ? 'selected' : '') ?>>Ravenclaw</option>
                <option value="4" <?= ($idCasa == 4 ? 'selected' : '') ?>>Hufflepuff</option>
            </select>

            <button class="btn btn-primary">Guardar elección</button>
        </form>
    </section>

    <div class="mt-4 d-flex justify-content-center gap-3">
        <a href="index.php?view=inicio" class="btn btn-primary">🏰 Volver al inicio</a>
        <a href="index.php?view=ranking" class="btn btn-outline-primary">📜 Ver ranking</a>
    </div>

  </div>
</main>

</body>
</html>
