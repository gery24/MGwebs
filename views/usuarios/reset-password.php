<h1>Restablecer Contraseña</h1>
<form method="POST" action="/controllers/UsuarioController.php?action=reset-password">
    <div>
        <label for="correo">Correo Electrónico:</label>
        <input type="email" name="correo" id="correo" required>
    </div>
    <button type="submit">Restablecer Contraseña</button>
</form>

<div style="margin-top: 20px;">
    <a href="/index.php"><button type="button">Volver al Inicio</button></a>
</div>

<?php
if (isset($_GET['error'])) {
    echo "<p style='color: red;'>".$_GET['error']."</p>";
}
if (isset($_GET['success'])) {
    echo "<p style='color: green;'>".$_GET['success']."</p>";
}
?> 