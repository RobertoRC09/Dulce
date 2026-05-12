<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Dulce Regionales</title>
    <link rel="stylesheet" href="assetes/css/style.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="logo">
            <h1>🍯 Únete a Dulce Regionales</h1>
            <p>Doña Solina</p>
        </div>

        <form method="POST" action="index.php?view=registro">
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" required placeholder="Tu nombre">
            </div>

            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" required placeholder="ejemplo@correo.com">
            </div>

            <div class="form-group">
                <label for="nombre_usuario">Nombre de Usuario</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" required placeholder="Usuario123">
            </div>

            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" id="contraseña" name="contraseña" required placeholder="Crea tu contraseña">
            </div>

            <button type="submit" class="btn-primary">Crear Cuenta</button>
            
            <div style="text-align: center; margin-top: 20px;">
                <a href="index.php" style="color: var(--text-muted); font-size: 14px;">¿Ya tienes cuenta? Inicia sesión</a>
            </div>
        </form>
    </div>
</body>
</html>
