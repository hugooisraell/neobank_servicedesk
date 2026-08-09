<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEOBANK - Service Desk Login</title>
    <!-- Vinculación del archivo de estilos externo -->
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="login-card">
        <h1 class="brand-title">NEOBANK</h1>
        <p class="brand-subtitle">Service Desk</p>

        <?php if (isset($error)): ?>
            <div class="error-alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form action="index.php?action=procesarLogin" method="POST">
            <div class="form-group">
                <label for="nombre_usuario">Usuario</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" placeholder="Ingresa tu usuario" required autocomplete="off">
            </div>

            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">Iniciar Sesión</button>
        </form>
    </div>

</body>
</html>