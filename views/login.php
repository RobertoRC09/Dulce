<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dulce Regionales</title>
    <link rel="stylesheet" href="assetes/css/style.css?v=3">
</head>
<body class="login-body">
    <div class="login-card">
        <h1>🍯 Dulce Regionales</h1>
        <p>Bienvenido, ingresa tus credenciales para continuar.</p>
        
        <?php if (isset($error)): ?>
            <div style="background: #fff5f5; color: #e53e3e; padding: 10px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="index.php?action=login" method="POST">
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="nombre_usuario" placeholder="Ingresa tu usuario" required>
            </div>
            
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="contraseña" placeholder="Ingresa tu contraseña" required>
            </div>

            <button type="submit" class="btn-block">Iniciar Sesión</button>
        </form>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #edf2f7; font-size: 12px; color: #7f8c8d;">
            <p><strong>Credenciales de prueba:</strong></p>
            <p>Usuario: admin@dulce.com | Pass: admin123</p>
        </div>
    </div>
</body>
</html>
