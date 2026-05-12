<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Dulce Regionales</title>
    <link rel="stylesheet" href="assetes/css/style.css?v=2">
</head>
<body>
    <?php include 'views/layout/navbar.php'; ?>

    <div class="container">
        <div class="section">
            <div class="section-header">
                <h3>🎁 Inventario de Productos</h3>
                <div style="display: flex; gap: 10px;">
                    <input type="text" id="searchProduct" placeholder="🔍 Buscar producto..." style="width: 250px; padding: 8px 15px; border-radius: 10px; border: 1px solid var(--border); font-size: 14px;" onkeyup="filterProducts()">
                    <button class="btn-secondary" onclick="window.print()" title="Imprimir Inventario">🖨️</button>
                    <button class="btn-primary" onclick="toggleModal('modalProducto')">+ Nuevo Producto</button>
                </div>
            </div>

            <div class="filter-container">
                <div class="chip active" onclick="filterByCategory('all', this)">Todos</div>
                <div class="chip" onclick="filterByCategory('Dulces', this)">Dulces</div>
                <div class="chip" onclick="filterByCategory('Conservas', this)">Conservas</div>
                <div class="chip" onclick="filterByCategory('Bebidas', this)">Bebidas</div>
                <div class="chip" onclick="filterByCategory('Textiles', this)">Textiles</div>
                <div class="chip" onclick="filterByCategory('Artesanías', this)">Artesanías</div>
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
                                   <span class="status-badge <?php 
                                       if ($prod['stock'] < 10) echo 'cancelado'; 
                                       elseif ($prod['stock'] < 30) echo 'pendiente'; 
                                       else echo 'completado'; 
                                   ?>">
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
                        <tr id="noResults" style="display: none;">
                            <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                🔍 No se encontraron productos que coincidan con tu búsqueda.
                            </td>
                        </tr>
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

        function filterProducts() {
            const input = document.getElementById('searchProduct');
            const filter = input.value.toLowerCase();
            const table = document.querySelector('table');
            const tr = table.getElementsByTagName('tr');
            let anyVisible = false;

            for (let i = 1; i < tr.length - 1; i++) {
                const td = tr[i].getElementsByTagName('td');
                let found = false;
                for (let j = 0; j < td.length - 1; j++) {
                    if (td[j].textContent.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
                tr[i].style.display = found ? '' : 'none';
                if (found) anyVisible = true;
            }

            document.getElementById('noResults').style.display = anyVisible ? 'none' : '';
        }

        function filterByCategory(category, element) {
            // Actualizar UI de los chips
            document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
            element.classList.add('active');

            const table = document.querySelector('table');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const catCell = tr[i].getElementsByTagName('td')[1];
                if (category === 'all' || catCell.textContent.trim() === category) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }

        // Cerrar modal al hacer clic fuera del contenido
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }
    </script>
    <footer style="text-align: center; padding: 40px; color: var(--text-muted); font-size: 14px;">
        &copy; <?php echo date('Y'); ?> Dulce Regionales: Doña Solina. Todos los derechos reservados.
    </footer>
</body>
</html>
