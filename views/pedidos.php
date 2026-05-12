<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos - Dulce Regionales</title>
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
                <h3>📦 Registro de Ventas</h3>
                <button class="btn-primary" onclick="toggleModal('modalPedido')">+ Nueva Venta</button>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Producto</th>
                            <th>Cant.</th>
                            <th>Total</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidos as $ped): ?>
                            <tr>
                               <td><span style="color: var(--text-muted);">#<?php echo $ped['id_pedido']; ?></span></td>
                               <td><strong><?php echo htmlspecialchars($ped['nombre'] . ' ' . $ped['apellido']); ?></strong></td>
                               <td><?php echo htmlspecialchars($ped['nombre_producto']); ?></td>
                               <td><?php echo $ped['cantidad']; ?></td>
                               <td><strong>$<?php echo number_format($ped['total'], 2); ?></strong></td>
                               <td><?php echo date('d/m/Y', strtotime($ped['fecha_pedido'])); ?></td>
                               <td><span class="status-badge completado">Pagado</span></td>
                               <td>
                                   <form method="POST" style="display:inline;">
                                       <input type="hidden" name="accion" value="eliminar">
                                       <input type="hidden" name="id_pedido" value="<?php echo $ped['id_pedido']; ?>">
                                       <button type="submit" class="btn-danger" onclick="return confirm('¿Eliminar venta?')">🗑️</button>
                                   </form>
                               </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modalPedido" class="modal">
        <div class="modal-content">
            <h3>Nueva Venta Regional</h3>
            <form method="POST">
                <input type="hidden" name="accion" value="crear">
                
                <div class="form-group">
                    <label>Cliente</label>
                    <select name="id_cliente" required>
                        <option value="">-- Seleccione un cliente --</option>
                        <?php foreach ($clientes as $cli): ?>
                            <option value="<?php echo $cli['id_cliente']; ?>">
                                <?php echo htmlspecialchars($cli['nombre'] . ' ' . $cli['apellido']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Producto</label>
                    <select name="id_producto" id="select_producto" required onchange="updatePrice()">
                        <option value="" data-price="0">-- Seleccione un producto --</option>
                        <?php foreach ($productos as $prod): ?>
                            <option value="<?php echo $prod['id_producto']; ?>" data-price="<?php echo $prod['precio']; ?>">
                                <?php echo htmlspecialchars($prod['nombre_producto'] . ' ($' . $prod['precio'] . ')'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Cantidad</label>
                    <input type="number" name="cantidad" id="input_cantidad" min="1" value="1" required oninput="calculateTotal()">
                </div>

                <div class="total-display">
                    <span>Total a cobrar:</span>
                    <strong id="display_total">$0.00</strong>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="toggleModal('modalPedido')">Cancelar</button>
                    <button type="submit" class="btn-primary">Finalizar Venta</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('active');
        }

        function updatePrice() { calculateTotal(); }
        function calculateTotal() {
            const select = document.getElementById('select_producto');
            const cantidad = document.getElementById('input_cantidad').value;
            const price = select.options[select.selectedIndex].getAttribute('data-price');
            const total = price * cantidad;
            document.getElementById('display_total').innerText = '$' + total.toFixed(2);
        }
    </script>
</body>
</html>
