<?php
session_start();

$action = $_GET['action'] ?? null;

// Función para verificar acceso según el rol requerido
function verificarAcceso($roleRequerido) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $roleRequerido) {
        echo "Acceso denegado. No tienes permiso para acceder a esta página.";
        exit();
    }
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'productos':
            require_once 'controllers/ProductoController.php';
            mostrarProductos();
            break;
        case 'login':
            include 'views/usuarios/login.php';
            break;
        case 'register':
            include 'views/usuarios/register.php';
            break;
        case 'reset-password':
            include 'views/usuarios/reset-password.php';
            break;
        case 'admin':
            require_once 'controllers/ProductoController.php';
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'add-product':
                        mostrarFormularioProducto();
                        break;
                    case 'edit-product':
                        mostrarFormularioProducto($_GET['id']);
                        break;
                    default:
                        mostrarPanelAdmin();
                }
            } else {
                mostrarPanelAdmin();
            }
            break;
        case 'logout':
            session_start();
            session_destroy();
            header('Location: /index.php');
            exit();
            break;
        case 'perfil':
            session_start();
            if (!isset($_SESSION['user_id'])) {
                header('Location: /index.php?page=login');
                exit();
            }
            include 'views/usuarios/perfil.php';
            break;
        case 'producto-detalle':
            include 'views/productos/detalle.php';
            break;
        default:
            echo "Página no encontrada";
            break;
    }
} else {
    // Mostrar la lista de productos en la página inicial
    require_once 'controllers/ProductoController.php';
    mostrarProductos();
}

switch ($action) {
    case 'mostrar-productos':
        include __DIR__ . '/controllers/ProductoController.php';
        mostrarProductos();
        break;

    // Otros casos...

    default:
        include __DIR__.'/resource_portada.php';
        break;
}