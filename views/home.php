<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Dulce Regionales</title>
    <link rel="stylesheet" href="assetes/css/style.css?v=2">
    <link rel="stylesheet" href="assetes/css/style_home.css?v=2">
</head>
<body>
    <div class="navbar">
        <h1>🍯 Dulce Regionales</h1>
        <div class="user-info">
            <nav style="display: flex; gap: 20px; align-items: center;">
                <a href="?view=home" class="nav-link <?php echo ($_GET['view'] == 'home' || !isset($_GET['view'])) ? 'active' : ''; ?>">Dashboard</a>
                <a href="?view=clientes" class="nav-link <?php echo ($_GET['view'] == 'clientes') ? 'active' : ''; ?>">Clientes</a>
                <a href="?view=productos" class="nav-link <?php echo ($_GET['view'] == 'productos') ? 'active' : ''; ?>">Productos</a>
                <a href="?view=pedidos" class="nav-link <?php echo ($_GET['view'] == 'pedidos') ? 'active' : ''; ?>">Pedidos</a>
                <a href="?view=logout" class="logout-btn">Salir</a>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="greeting">
            <h2>¡Hola, <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?>!</h2>
            <p>Bienvenido al sistema de control de "Doña Solina". Todo está bajo control hoy.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <span class="icon">👥</span>
                <div class="label">Clientes</div>
                <div class="value"><?php echo $total_clientes; ?></div>
            </div>
            <div class="stat-card">
                <span class="icon">🎁</span>
                <div class="label">Productos</div>
                <div class="value"><?php echo $total_productos; ?></div>
            </div>
            <div class="stat-card">
                <span class="icon">📦</span>
                <div class="label">Ventas Hoy</div>
                <div class="value"><?php echo $total_pedidos; ?></div>
            </div>
            <div class="stat-card">
                <span class="icon">💰</span>
                <div class="label">Ingresos</div>
                <div class="value">$<?php echo number_format($ingreso_total, 2); ?></div>
            </div>
        </div>

        <div class="section">
            <h3>📈 Alertas de Inventario</h3>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Producto Regional</th>
                            <th>Stock Actual</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $alerta = false; foreach ($productos_stock as $prod): ?>
                            <?php if ($prod['stock'] < 10): $alerta = true; ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($prod['nombre_producto']); ?></strong></td>
                                    <td><?php echo $prod['stock']; ?> unidades</td>
                                    <td><span class="status-badge cancelado">Stock Bajo</span></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if (!$alerta): ?>
                            <tr><td colspan="3" style="text-align: center; color: var(--text-muted); padding: 40px;">✅ Todos los productos tienen stock suficiente.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section">
            <h3>🛒 Actividad Reciente</h3>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID Venta</th>
                            <th>Cliente</th>
                            <th>Monto Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pedidos_recientes)): ?>
                            <?php $limit = 0; foreach ($pedidos_recientes as $ped): if ($limit++ > 4) break; ?>
                                <tr>
                                    <td>#<?php echo $ped['id_pedido']; ?></td>
                                    <td><?php echo htmlspecialchars($ped['nombre'] . ' ' . $ped['apellido']); ?></td>
                                    <td><strong>$<?php echo number_format($ped['total'], 2); ?></strong></td>
                                    <td><span class="status-badge completado">Pagado</span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" style="text-align: center; color: var(--text-muted); padding: 40px;">Aún no se han registrado ventas hoy.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
