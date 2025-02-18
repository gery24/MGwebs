<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h1>Registro</h1>
    <form action="index.php?action=procesarRegistro" method="POST">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <label for="nombre">Nombre Completo:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
