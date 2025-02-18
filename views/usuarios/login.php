<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <style>
        .btn-submit {
            background-color: #064111;
        }
    </style>
</head>
<body>
    <div class="header-common">
        <div class="container">
            <div class="logo-container">
                <a href="/index.php">
                <img src="/imagenes/logo.png" alt="MG Logo">
                </a>
            </div>
        </div>
    </div>
    <h1>Iniciar Sesión</h1>
    <form method="POST" action="/controllers/UsuarioController.php?action=login">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Iniciar sesión</button>
    </form>
    <p>¿No tienes cuenta? <a href="?page=register">Regístrate aquí</a></p>
    <p>¿Olvidaste tu contraseña? <a href="?page=reset-password">Restablecer contraseña</a></p>
    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color: red;'>".$_GET['error']."</p>";
    }
    if (isset($_GET['success'])) {
        echo "<p style='color: green;'>".$_GET['success']."</p>";
    }
    ?>
</body>
</html>
