<!-- resource_login.php -->
<html lang="ca">
<head>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Iniciar sesión</h2>

        <!-- Mostrar error si las credenciales son incorrectas -->
        <?php if (isset($_GET['error'])): ?>
            <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <form method="POST" action="/controllers/UsuarioController.php?action=login">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>
            <br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <br>

            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>
