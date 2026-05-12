<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes - Dulce Regionales</title>
    <link rel="stylesheet" href="assetes/css/style.css?v=2">
    <link rel="stylesheet" href="assetes/css/style_cliente.css?v=2">
</head>
<body>
    <div class="navbar">
        <h1>🍯 Dulce Regionales</h1>
        <div class="user-info">
            <nav style="display: flex; gap: 20px; align-items: center;">
                <a href="?view=home" class="nav-link <?php echo ($_GET['view'] == 'home') ? 'active' : ''; ?>">Dashboard</a>
                <a href="?view=clientes" class="nav-link <?php echo ($_GET['view'] == 'clientes') ? 'active' : ''; ?>">Clientes</a>
                <a href="?view=productos" class="nav-link <?php echo ($_GET['view'] == 'productos') ? 'active' : ''; ?>">Productos</a>
                <a href="?view=pedidos" class="nav-link <?php echo ($_GET['view'] == 'pedidos') ? 'active' : ''; ?>">Pedidos</a>
                <a href="?view=logout" class="logout-btn">Salir</a>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="section">
            <div class="section-header">
                <h3>👥 Gestión de Clientes</h3>
                <button class="btn-primary" onclick="toggleModal('modalCliente')">+ Nuevo Cliente</button>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>DNI</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($clientes)): ?>
                            <?php foreach ($clientes as $cli): ?>
                                <tr>
                                   <td><span style="color: var(--text-muted);">#<?php echo $cli['id_cliente']; ?></span></td>
                                   <td><strong><?php echo htmlspecialchars($cli['nombre'] . ' ' . $cli['apellido']); ?></strong></td>
                                   <td><?php echo htmlspecialchars($cli['dni']); ?></td>
                                   <td><?php echo htmlspecialchars($cli['telefono']); ?></td>
                                   <td><?php echo htmlspecialchars($cli['correo']); ?></td>
                                   <td>
                                       <form method="POST" style="display:inline;">
                                           <input type="hidden" name="accion" value="eliminar">
                                           <input type="hidden" name="id_cliente" value="<?php echo $cli['id_cliente']; ?>">
                                           <button type="submit" class="btn-danger" onclick="return confirm('¿Eliminar cliente?')">🗑️</button>
                                       </form>
                                   </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" style="text-align: center; padding: 40px; color: var(--text-muted);">No hay clientes registrados.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo Cliente (Invisible por defecto) -->
    <div id="modalCliente" class="modal">
        <div class="modal-content">
            <h3>Registrar Nuevo Cliente</h3>
            <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 20px;">Completa los datos para añadir un cliente a Doña Solina.</p>
            
            <form method="POST">
                <input type="hidden" name="accion" value="crear">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" required placeholder="Ej: Juan">
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="apellido" required placeholder="Ej: Pérez">
                    </div>
                </div>
                <div class="form-group">
                    <label>DNI</label>
                    <input type="text" name="dni" required placeholder="Documento de identidad">
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" placeholder="Número de contacto">
                </div>
                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" name="direccion" placeholder="Dirección de domicilio">
                </div>
                <div class="form-group">
                    <label>Correo Electrónico</label>
                    <input type="email" name="correo" placeholder="correo@ejemplo.com">
                </div>
                
                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="toggleModal('modalCliente')">Cancelar</button>
                    <button type="submit" class="btn-primary">Guardar Cliente</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('active');
        }
    </script>
</body>
</html>
