<?php
// index.php
session_start();

$action = $_GET['action'] ?? null;

// Función para verificar acceso según el rol requerido
function verificarAcceso($roleRequerido) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $roleRequerido) {
        echo "Acceso denegado. No tienes permiso para acceder a esta página.";
        exit();
    }
}

switch ($action) {
    // Recursos existentes
    case 'llistar-categories':
        include __DIR__.'/resource_llistar_categories.php';
        break;

    case 'registre':
        include __DIR__.'/resource_registre.php';
        break;

    case 'registre-session':
        include __DIR__.'/controller/almacenar_registro.php';
        break;

    case 'mostrar-productos':
        include __DIR__ . '/controller/mostrar_productos.php';
        break;

    case 'mostrar-productos-categoria':
        include __DIR__ . '/controller/mostrar_productos_por_categoria.php';
        include __DIR__ . '/resource_mostrar_productos_por_categoria.php';
        break;

    case 'login':
        include __DIR__ . '/controller/resource_login.php';
        break;

    // Nuevo: Dashboard para usuarios administradores
    case 'admin-dashboard':
        verificarAcceso('administrador');
        include __DIR__ . '/views/usuarios/admin_dashboard.php';
        break;

    // Nuevo: Perfil de usuario (disponible para cualquier usuario)
    case 'user-profile':
        if (!isset($_SESSION['user_id'])) {
            echo "Debes iniciar sesión para acceder a tu perfil.";
            exit();
        }
        include __DIR__ . '/views/usuarios/user_profile.php';
        break;

    // Nuevo: Logout
    case 'logout':
        session_destroy();
        header('Location: /index.php?action=login');
        break;

    // Recurso por defecto
    default:
        include __DIR__.'/resource_portada.php';
        break;
}
?>
