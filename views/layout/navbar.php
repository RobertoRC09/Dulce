<div class="navbar">
    <h1>🍯 Dulce Regionales</h1>
    <div class="user-info">
        <nav style="display: flex; gap: 20px; align-items: center;">
            <a href="?view=home" class="nav-link <?php echo (!isset($_GET['view']) || $_GET['view'] == 'home') ? 'active' : ''; ?>">Dashboard</a>
            <a href="?view=clientes" class="nav-link <?php echo (isset($_GET['view']) && $_GET['view'] == 'clientes') ? 'active' : ''; ?>">Clientes</a>
            <a href="?view=productos" class="nav-link <?php echo (isset($_GET['view']) && $_GET['view'] == 'productos') ? 'active' : ''; ?>">Productos</a>
            <a href="?view=pedidos" class="nav-link <?php echo (isset($_GET['view']) && $_GET['view'] == 'pedidos') ? 'active' : ''; ?>">Pedidos</a>
            <a href="?view=logout" class="logout-btn">Salir</a>
        </nav>
    </div>
</div>
