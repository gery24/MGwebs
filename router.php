<?php
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
        default:
            echo "Página no encontrada";
            break;
    }
} else {
    // Mostrar la lista de productos en la página inicial
    require_once 'controllers/ProductoController.php';
    mostrarProductos();
}