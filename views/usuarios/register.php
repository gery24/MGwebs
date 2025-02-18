<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
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
    <h1>Registro de Usuario</h1>
    <form method="POST" action="/controllers/UsuarioController.php?action=register">
        <div>
            <label for="usuario">Nombre de Usuario:</label>
            <input type="text" name="usuario" id="usuario" required>
        </div>
        <div>
            <label for="correo">Correo Electrónico:</label>
            <input type="email" name="correo" id="correo" required>
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
        </div>
        <button type="submit">Registrarse</button>
    </form>
    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color: red;'>".$_GET['error']."</p>";
    }
    ?> 
</body>
</html> 