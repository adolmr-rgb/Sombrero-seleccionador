<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Ranking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilos.css">

  <style>
    thead th {
      background-color: #000;
      color: #fff;
      text-align: center;
      font-weight: bold;
    }
    tbody td {
      color: #fff;
      font-weight: bold;
      text-align: center;
    }

    /* Colores de fila por casa */
    .fila-gryffindor { background-color: rgba(180, 30, 30, 0.25) !important; }
    .fila-slytherin  { background-color: rgba(0, 150, 70, 0.25) !important; }
    .fila-ravenclaw  { background-color: rgba(20, 60, 200, 0.25) !important; }
    .fila-hufflepuff { background-color: rgba(200, 160, 20, 0.25) !important; }

    .fila-gryffindor:hover { background-color: rgba(180, 30, 30, 0.45) !important; }
    .fila-slytherin:hover  { background-color: rgba(0, 150, 70, 0.45) !important; }
    .fila-ravenclaw:hover  { background-color: rgba(20, 60, 200, 0.45) !important; }
    .fila-hufflepuff:hover { background-color: rgba(200, 160, 20, 0.45) !important; }

    /* Barra mágica */
    .barra-magica {
      position: relative;
      height: 12px;
      border-radius: 6px;
      overflow: hidden;
      background: rgba(255, 255, 255, 0.1);
      margin: 8px auto 15px;
      width: 80%;
      box-shadow: 0 0 8px rgba(255, 215, 0, 0.4);
    }

    .barra-energia {
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 0%;
      border-radius: 6px;
      animation: brilloMagico 2s infinite alternate;
      transition: width 2s ease-in-out;
    }

    @keyframes brilloMagico {
      0% { filter: brightness(1); }
      100% { filter: brightness(1.5); }
    }

    /* Colores por casa */
    .barra-gryffindor .barra-energia {
      background: linear-gradient(90deg, #7b1113, #ff3333, #c69c2d);
    }
    .barra-slytherin .barra-energia {
      background: linear-gradient(90deg, #0b3d0b, #00cc66, #c69c2d);
    }
    .barra-ravenclaw .barra-energia {
      background: linear-gradient(90deg, #1a237e, #3399ff, #c69c2d);
    }
    .barra-hufflepuff .barra-energia {
      background: linear-gradient(90deg, #b8860b, #ffcc33, #fff1a1);
    }
  </style>
</head>

<body class="bg-dark text-light">

<header class="py-2 bg-gradient">
  <div class="container d-flex justify-content-between align-items-center">
    <h1 class="h4 mb-0">Ranking Global</h1>
    <a href="index.php?view=inicio" class="btn btn-primary">🏰 Volver al inicio</a>
  </div>
</header>

<main class="container py-4">

  <!-- Totales por casa -->
  <section class="mb-4">
    <h2>Totales por casa</h2>
    <div class="row text-center">

      <?php 
      $casas = ['Gryffindor','Slytherin','Ravenclaw','Hufflepuff'];
      foreach ($casas as $casa): 
        $total = intval($totales[$casa] ?? 0);
        $porcentaje = ($maxPuntos > 0) ? round(($total / $maxPuntos) * 100) : 0;
        $claseBarra = 'barra-' . strtolower($casa);
      ?>
        <div class="col-6 col-md-3 mb-3">
          <div class="bg-secondary bg-opacity-25 rounded py-3">
            <img src="img/<?=strtolower($casa)?>.png" alt="<?=$casa?>" style="width:60px;height:auto;">
            <h5 class="mt-2"><?=htmlspecialchars($casa)?></h5>

            <!-- Barra mágica animada -->
            <div class="barra-magica <?=$claseBarra?>">
              <div class="barra-energia" style="width: <?=$porcentaje?>%;"></div>
            </div>

            <p class="mt-2 mb-0"><?=$total?> puntos</p>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </section>

  <!-- Últimos resultados -->
  <section>
    <h2>Últimos resultados</h2>
    <div class="table-responsive bg-light text-dark p-2 rounded">
      <table class="table table-striped mb-0">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Casa</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($lista)): ?>
            <?php foreach ($lista as $r): ?>

              <?php
              $claseFila = 'fila-' . strtolower($r['nombre_casa']);
              ?>

              <tr class="<?= $claseFila ?>">
                <td><?= date("d/m/Y", strtotime($r['fecha'])) ?></td>
                <td><?= htmlspecialchars($r['usuario']) ?></td>
                <td><?= htmlspecialchars($r['nombre_casa']) ?></td>
              </tr>

            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3">No hay resultados disponibles.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </section>

</main>

<!-- Sonido solo al cargar barras -->
<audio id="soundBars" src="audio/magic-whoosh.mp3"></audio>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const barras = document.querySelectorAll(".barra-energia");
    const sound = document.getElementById("soundBars");
    sound.volume = 0.5;

    barras.forEach((barra, i) => {
      const finalWidth = barra.style.width;
      barra.style.width = "0%";

      setTimeout(() => {
        barra.style.width = finalWidth;

        // sonido solo al empezar la primera barra
        if (i === 0) sound.play().catch(()=>{});
      }, 350 + i * 250);
    });
  });
</script>

</body>
</html>

