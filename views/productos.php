<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Dulce Regionales</title>
    <link rel="stylesheet" href="assetes/css/style.css?v=2">
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
                <h3>🎁 Inventario de Productos</h3>
                <button class="btn-primary" onclick="toggleModal('modalProducto')">+ Nuevo Producto</button>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Origen</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $prod): ?>
                            <tr>
                               <td><strong><?php echo htmlspecialchars($prod['nombre_producto']); ?></strong></td>
                               <td><span class="status-badge" style="background: #f1f5f9; color: #475569;"><?php echo htmlspecialchars($prod['categoria']); ?></span></td>
                               <td><?php echo htmlspecialchars($prod['region_origen']); ?></td>
                               <td><strong>$<?php echo number_format($prod['precio'], 2); ?></strong></td>
                               <td>
                                   <span class="status-badge <?php echo $prod['stock'] < 10 ? 'cancelado' : 'completado'; ?>">
                                       <?php echo $prod['stock']; ?> unidades
                                   </span>
                               </td>
                               <td>
                                   <form method="POST" style="display:inline;">
                                       <input type="hidden" name="accion" value="eliminar">
                                       <input type="hidden" name="id_producto" value="<?php echo $prod['id_producto']; ?>">
                                       <button type="submit" class="btn-danger" onclick="return confirm('¿Eliminar producto?')">🗑️</button>
                                   </form>
                               </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modalProducto" class="modal">
        <div class="modal-content">
            <h3>Nuevo Producto Regional</h3>
            <form method="POST">
                <input type="hidden" name="accion" value="crear">
                <div class="form-group">
                    <label>Nombre del Producto</label>
                    <input type="text" name="nombre_producto" required placeholder="Ej: Alfajores de Miel">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Categoría</label>
                        <select name="categoria">
                            <option value="Dulces">Dulces</option>
                            <option value="Conservas">Conservas</option>
                            <option value="Bebidas">Bebidas</option>
                            <option value="Textiles">Textiles</option>
                            <option value="Artesanías">Artesanías</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Región</label>
                        <input type="text" name="region_origen" placeholder="Pucallpa, Iquitos...">
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Precio (S/.)</label>
                        <input type="number" step="0.01" name="precio" required>
                    </div>
                    <div class="form-group">
                        <label>Stock Inicial</label>
                        <input type="number" name="stock" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" placeholder="Detalles del producto..."></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="toggleModal('modalProducto')">Cancelar</button>
                    <button type="submit" class="btn-primary">Registrar Producto</button>
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
