<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MG - La web de las webs</title>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .nav-buttons {
            display: flex;
            gap: 10px;
        }
        .title-section {
            text-align: center;
            padding: 40px 0;
            background-color: #fff;
        }
        .main-title {
            font-size: 2.5em;
            color: #064111;
            margin: 0;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .subtitle {
            font-size: 1.2em;
            color: #333;
            margin: 0;
        }
        .productos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .producto-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background-color: white;
        }
        .producto-card h2 {
            color: #333;
            margin-top: 0;
        }
        .producto-precio {
            font-size: 1.2em;
            color: #2c5282;
            font-weight: bold;
        }
        .no-productos {
            text-align: center;
            padding: 20px;
            color: #666;
        }
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            text-decoration: none;
        }
        .btn-login {
            background-color: white;
            color: #064111;
            border: 2px solid #064111;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: #064111;
            color: white;
        }
        .btn-register {
            background-color: #064111;
            color: white;
            border: 2px solid #064111;
        }
        .btn-register:hover {
            background-color: #053010;
            border-color: #053010;
        }
        .btn-admin {
            background-color: #dc3545;
            color: white;
        }
        .user-menu {
            position: relative;
            display: inline-block;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            background-color: #064111;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 4px;
        }
        .dropdown-menu a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
        .user-menu:hover .dropdown-menu {
            display: block;
        }
        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .admin-button {
            background-color: #dc3545;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
        }
        .admin-button:hover {
            background-color: #c82333;
        }
        .btn-submit {
            background-color: #064111;
        }
        .filter-section {
            background-color: #f8f9fa;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .filter-form {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }

        .filter-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .filter-form input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .filter-form input[type="number"] {
            width: 120px;
        }

        .filter-form input[type="text"] {
            width: 200px;
        }

        .btn-filter {
            background-color: #064111;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-filter:hover {
            background-color: #053010;
        }

        .btn-clear {
            background-color: #6c757d;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-clear:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    

    <div class="header">
        <div class="header-common">
            <div class="container">
                <div class="logo-container">
                    <a href="/index.php">
                        <img src="/imagenes/logo.png" alt="MG Logo">
                    </a>
                </div>
            </div>
        </div>

        <div class="header-left">
            <?php
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrador') {
                echo '<a href="?page=admin" class="admin-button">Panel Admin</a>';
            }
            ?>
        </div>
        <div class="nav-buttons">
            <?php
            if (!isset($_SESSION['user_id'])) {
                // Usuario no logueado
                echo '<a href="?page=login" class="btn btn-login">Iniciar Sesión</a>';
                echo '<a href="?page=register" class="btn btn-register">Registrarse</a>';
            } else {
                // Usuario logueado
                echo '<div class="user-menu">';
                echo '<div class="user-avatar">' . strtoupper(substr($_SESSION['username'], 0, 1)) . '</div>';
                echo '<div class="dropdown-menu">';
                if ($_SESSION['role'] === 'administrador') {
                    echo '<a href="?page=admin">Panel Admin</a>';
                }
                echo '<a href="?page=perfil">Ajustes de Perfil</a>';
                echo '<a href="?page=logout">Cerrar Sesión</a>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <div class="title-section">
        <h1 class="main-title">Bienvenidos a MG</h1>
        <p class="subtitle">La página web de las páginas web</p>
    </div>

    <div class="filter-section">
        <form class="filter-form" method="GET" action="/index.php">
            <div class="filter-group">
                <input type="text" name="nombre" placeholder="Buscar por nombre..." 
                       value="<?php echo isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : ''; ?>">
            </div>
            <div class="filter-group">
                <input type="number" name="precio_min" placeholder="Precio mínimo" step="0.01"
                       value="<?php echo isset($_GET['precio_min']) ? htmlspecialchars($_GET['precio_min']) : ''; ?>">
                <input type="number" name="precio_max" placeholder="Precio máximo" step="0.01"
                       value="<?php echo isset($_GET['precio_max']) ? htmlspecialchars($_GET['precio_max']) : ''; ?>">
            </div>
            <button type="submit" class="btn-filter">Filtrar</button>
            <?php if(isset($_GET['nombre']) || isset($_GET['precio_min']) || isset($_GET['precio_max'])): ?>
                <a href="/index.php" class="btn-clear">Limpiar filtros</a>
            <?php endif; ?>
        </form>
    </div>
    
    <div class="productos-grid">
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="producto-card">
                    <h2><?php echo htmlspecialchars($producto['nombre_producto']); ?></h2>
                    <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                    <p class="producto-precio"><?php echo number_format($producto['precio'], 2); ?> €</p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-productos">
                <p>No hay productos disponibles en este momento.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>