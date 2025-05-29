<?php
// index.php (como ejemplo de archivo completo)

// Detectar la página en $_GET (si no está definida, usar cadena vacía)
$page = isset($_GET['page']) ? $_GET['page'] : '';

?>

<button id="toggleSidebar" style="z-index:20" class="btn btn-primary position-fixed top-0 start-0 m-3 d-block">
    <i class="fas fa-bars"></i>
</button>

<div class="sidebar" id="sidebar">
    <div class="sidebar-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0 text-primary">My tools</h4>
        <button id="closeSidebar" class="btn btn-light btn-sm">✖</button>
    </div>
    <ul class="sidebar-menu flex-column mt-3">
        <!-- Opción 1: Inicio -->
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?php echo !isset($_GET['page']) ? 'active' : '' ?>">
                <i class="fas fa-home me-2"></i> Inicio
            </a>
        </li>
        <!-- Opción 2: Mi zona con  submenu -->
        <li class="nav-item">
            <a class="nav-link" id="btn-dropdown-zona" style="cursor: pointer;" data-bs-toggle="collapse"
                aria-expanded="false" aria-controls="dropdownZona">
                <i class="fas fa-user me-2"></i> Mi zona
                &nbsp;
                <i id="arrow_dropdown_zona" class="fas fa-chevron-<?php echo isset($_GET['s']) && $_GET['s'] === 'zone' ? 'down' : 'right' ?> float-end"></i>
            </a>
            <ul class="submenu_sidebar ps-3" style="display:<?php echo isset($_GET['s']) && $_GET['s'] === 'zone' ? 'block' : 'none' ?>" id="dropdownZona">
                <li style="list-style:none" class="nav-item">
                    <a href="?page=phone-listing&s=zone"
                        class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] === 'phone-listing') ? 'active' : '' ?>">
                        <i class="fas fa-chart-bar me-2"></i> Listing telefónico
                    </a>
                </li>
                <li style="list-style:none" class="nav-item">
                    <a href="?page=inglobaly&s=zone"
                        class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] === 'inglobaly') ? 'active' : '' ?>">
                        <i class="fas fa-users me-2"></i> Inglobaly
                    </a>
                </li>
                <li style="list-style:none" class="nav-item">
                    <a href="?page=abc-telefonos&s=zone"
                        class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] === 'abc-telefonos') ? 'active' : '' ?>">
                        <i class="fas fa-box me-2"></i> Abc teléfonos
                    </a>
                </li>
            </ul>
        </li>

        <!-- Opción 2: Mi pedidos con  submenu -->
        <li class="nav-item">
            <a class="nav-link" id="btn-dropdown-orders" style="cursor: pointer;" data-bs-toggle="collapse"
                aria-expanded="false" aria-controls="dropdownOrders">
                <i class="fas fa-user me-2"></i> Mis pedidos
                &nbsp;
                <i id="arrow_dropdown_orders" class="fas fa-chevron-<?php echo isset($_GET['s']) && $_GET['s'] === 'order' ? 'down' : 'right' ?> float-end"></i>
            </a>
            <ul class="submenu_sidebar ps-3" style="display:<?php echo isset($_GET['s']) && $_GET['s'] === 'order' ? 'block' : 'none' ?>" id="dropdownOrders">
                <li style="list-style:none" class="nav-item">
                    <a href="?page=order-listing&s=order"
                        class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] === 'order-listing') ? 'active' : '' ?>">
                        <i class="fas fa-chart-bar me-2"></i> Lista
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="?page=inglobaly"
                        class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] === 'inglobaly') ? 'active' : '' ?>">
                        <i class="fas fa-users me-2"></i> Inglobaly
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?page=abc-telefonos"
                        class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] === 'abc-telefonos') ? 'active' : '' ?>">
                        <i class="fas fa-box me-2"></i> Abc teléfonos
                    </a>
                </li> -->
            </ul>
        </li>
    </ul>

</div>