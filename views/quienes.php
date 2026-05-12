<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiénes Somos - Dulce Regionales</title>
    <link rel="stylesheet" href="assetes/css/style.css">
    <link rel="stylesheet" href="assetes/css/style_home.css">
</head>
<body>
    <div class="navbar">
        <h1>🍯 Dulce Regionales</h1>
        <div class="user-info">
            <a href="?view=home" class="nav-link">Dashboard</a>
            <a href="?view=quienes" class="nav-link active">Quiénes Somos</a>
            <form method="POST" style="margin: 0; display: inline;">
                <input type="hidden" name="logout" value="1">
                <button type="submit" class="logout-btn">Salir</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="greeting">
            <h2>Nuestra Historia</h2>
            <p>Conoce más sobre Dulces Regionales "Doña Solina"</p>
        </div>

        <div class="section" style="line-height: 1.8; font-size: 16px;">
            <p><strong>Dulce Regionales: Doña Solina</strong> es una pequeña empresa dedicada con pasión a la venta de productos regionales auténticos. Nuestra selección incluye café de altura, cacao puro, miel silvestre, textiles tradicionales y artesanías únicas.</p>
            
            <p style="margin-top: 20px;">Nacimos con la misión de llevar el sabor y la cultura de nuestras regiones a cada hogar, apoyando a los productores locales y garantizando la máxima calidad en cada entrega.</p>
            
            <div style="margin-top: 40px; display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <div style="background: #fdfaf5; padding: 20px; border-radius: 15px; border-left: 4px solid var(--primary);">
                    <h4 style="color: var(--primary-dark);">Misión</h4>
                    <p>Facilitar el acceso a productos regionales premium de forma rápida y sencilla.</p>
                </div>
                <div style="background: #fdfaf5; padding: 20px; border-radius: 15px; border-left: 4px solid var(--primary);">
                    <h4 style="color: var(--primary-dark);">Visión</h4>
                    <p>Ser el referente número uno en la distribución de dulces y artesanías regionales del país.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
