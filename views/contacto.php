<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Dulce Regionales</title>
    <link rel="stylesheet" href="assetes/css/style.css">
    <link rel="stylesheet" href="assetes/css/style_home.css">
</head>
<body>
    <div class="navbar">
        <h1>🍯 Dulce Regionales</h1>
        <div class="user-info">
            <a href="?view=home" class="nav-link">Dashboard</a>
            <a href="?view=contacto" class="nav-link active">Contacto</a>
            <form method="POST" style="margin: 0; display: inline;">
                <input type="hidden" name="logout" value="1">
                <button type="submit" class="logout-btn">Salir</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="section" style="max-width: 600px; margin: 0 auto;">
            <div class="logo">
                <h2 style="color: var(--primary-dark); margin-bottom: 20px;">📩 Contáctanos</h2>
                <p>¿Tienes dudas sobre los productos de Doña Solina?</p>
            </div>

            <form action="#" method="POST" style="margin-top: 30px;">
                <div class="form-group">
                    <label>Asunto</label>
                    <input type="text" placeholder="¿En qué podemos ayudarte?">
                </div>
                <div class="form-group">
                    <label>Mensaje</label>
                    <textarea style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; min-height: 150px;" placeholder="Escribe aquí tu mensaje..."></textarea>
                </div>
                <button type="button" class="btn-primary" onclick="alert('Mensaje enviado (Simulación)')">Enviar Mensaje</button>
            </form>
        </div>
    </div>
</body>
</html>
