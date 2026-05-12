<div class="navbar">
    <div style="display: flex; align-items: center; gap: 15px;">
        <h1>🍯 Dulce Regionales</h1>
        <span id="realTimeClock" style="font-size: 13px; color: var(--text-muted); background: #f8fafc; padding: 5px 12px; border-radius: 20px; border: 1px solid var(--border);"></span>
    </div>

    <div class="user-info">
        <nav style="display: flex; gap: 20px; align-items: center;">
            <a href="?view=home" class="nav-link <?php echo (!isset($_GET['view']) || $_GET['view'] == 'home') ? 'active' : ''; ?>">Dashboard</a>
            <a href="?view=clientes" class="nav-link <?php echo (isset($_GET['view']) && $_GET['view'] == 'clientes') ? 'active' : ''; ?>">Clientes</a>
            <a href="?view=productos" class="nav-link <?php echo (isset($_GET['view']) && $_GET['view'] == 'productos') ? 'active' : ''; ?>">Productos</a>
            <a href="?view=pedidos" class="nav-link <?php echo (isset($_GET['view']) && $_GET['view'] == 'pedidos') ? 'active' : ''; ?>">Pedidos</a>
            <a href="?view=logout" class="logout-btn" onclick="return confirm('¿Estás seguro de que quieres salir del sistema?')">Salir</a>
        </nav>
    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        const options = { weekday: 'short', day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit', second: '2-digit' };
        document.getElementById('realTimeClock').innerText = now.toLocaleDateString('es-ES', options);
    }
    setInterval(updateClock, 1000);
    updateClock();

    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 10) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
