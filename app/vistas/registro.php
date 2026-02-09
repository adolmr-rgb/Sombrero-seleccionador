<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Registro</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/estilos.css">

</head>
<body class="bg-dark text-light">

<div class="container py-5">
    <div class="mx-auto" style="max-width:360px;"> <!-- ancho ajustado -->

        <h2 class="mb-4 text-center">Registro</h2>

        <?php if (!empty($error)): ?>
            <p class="text-danger text-center"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post" action="index.php?view=registro" class="bg-light p-4 rounded shadow-sm text-dark">

            <!-- Usuario -->
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input name="usuario" class="form-control w-100" required>
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input name="password" type="password" class="form-control w-100" required>
            </div>

            <button class="btn btn-primary w-100">Registrarse</button>

        </form>

        <p class="mt-3 text-center">
            ¿Ya tienes cuenta? <a href="index.php?view=login">Inicia sesión</a>
        </p>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
