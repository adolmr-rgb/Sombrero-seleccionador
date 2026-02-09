<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/estilos.css">

<style>
.form-control {
    width: 100%;
    display: block;
    margin: 0 auto 10px auto;
}
</style>

</head>
<body class="bg-dark text-light">

<div class="container py-5">
    <div class="mx-auto" style="max-width:360px;"> 

        <h2 class="text-center mb-4">Iniciar sesión</h2>

        <?php if (!empty($mensaje)): ?>
            <p class="text-danger text-center"><?= htmlspecialchars($mensaje) ?></p>
        <?php endif; ?>

        <form method="post" action="index.php?view=login" class="bg-light p-4 rounded shadow text-dark">

            <div class="mb-3">
                <label class="form-label">Usuario:</label>
                <input name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña:</label>
                <input name="password" type="password" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Entrar</button>

        </form>

        <p class="mt-3 text-center">
            ¿No tienes cuenta? <a href="index.php?view=registro">Regístrate</a>
        </p>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
