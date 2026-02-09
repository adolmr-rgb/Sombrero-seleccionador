<!--Aquí mostramos el test del Sombrero con todas las preguntas y opciones para que el usuario descubra su casa. -->
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Test - Sombrero</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/estilos.css">

</head>
<body class="bg-dark text-light">

<header class="py-2 bg-gradient">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="h4 mb-0">Test del Sombrero</h1>
        <div>
            <a href="index.php?view=inicio" class="btn btn-sm btn-outline-light">Inicio</a>
            <a href="index.php?view=ranking" class="btn btn-sm btn-outline-light">Ranking</a>
        </div>
    </div>
</header>

<main class="container py-4">

<div class="row">

    
    <div class="col-lg-8 col-md-7">

        <form id="testForm" class="test-form bg-parchment text-dark p-4 rounded shadow-lg">

            <?php $i = 1; foreach ($preguntas as $p): ?>
                <fieldset class="mb-4 border-bottom pb-3">

                    <legend class="fw-bold text-gold fs-5">
                        Pregunta <?= $i ?>: <?= htmlspecialchars($p['texto']) ?>
                    </legend>

                    <?php if (!empty($opciones[$p['id_pregunta']])): ?>
                        <?php foreach ($opciones[$p['id_pregunta']] as $opt): ?>
                            <div class="form-check mb-2">
                                <input class="form-check-input"
                                       type="radio"
                                       name="q<?= $p['id_pregunta'] ?>"
                                       id="opt<?= $opt['id_opcion'] ?>"
                                       value="<?= $opt['id_casa'] ?>">
                                <label class="form-check-label" for="opt<?= $opt['id_opcion'] ?>">
                                    <?= htmlspecialchars($opt['texto_opcion']) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </fieldset>
            <?php $i++; endforeach; ?>

            <div class="text-center mt-4">
                <button type="button" class="btn btn-primary btn-enviar" id="enviarBtn">
                    Enviar respuestas
                </button>
            </div>

        </form>

    </div>

    <!-- Sombrero -->
    <div class="col-lg-4 col-md-5 d-flex align-items-start justify-content-center">
        <div id="hatArea" class="hat-area text-center" hidden>
            <p id="hatText" class="fs-5 mb-2">El Sombrero está pensando...</p>
            <img id="hatImg" src="img/hat.png" alt="Sombrero" class="hat">
        </div>
    </div>

</div>

</main>

<!-- ID DEL USUARIO (lo usa script.js) -->
<script>
    const userId = <?= json_encode($_SESSION['user']['id'] ?? null) ?>;
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>

