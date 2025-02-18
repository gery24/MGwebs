<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ajustes de Perfil</title>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <style>
        .profile-form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn-submit {
            background-color: #064111;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="header-common">
        <div class="container">
            <div class="logo-container">
                <a href="/index.php">
                    <img src="/public/assets/img/logo.png" alt="MG Logo">
                </a>
            </div>
        </div>
    </div>
    <div class="profile-form">
        <h1>Ajustes de Perfil</h1>
        
        <?php if (isset($_GET['success'])): ?>
            <p style="color: green;"><?php echo $_GET['success']; ?></p>
        <?php endif; ?>
        
        <?php if (isset($_GET['error'])): ?>
            <p style="color: red;"><?php echo $_GET['error']; ?></p>
        <?php endif; ?>

        <form method="POST" action="/controllers/UsuarioController.php?action=update-profile">
            <div class="form-group">
                <label for="nombre">Nombre de Usuario:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $_SESSION['username']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password_actual">Contraseña Actual:</label>
                <input type="password" id="password_actual" name="password_actual">
            </div>
            
            <div class="form-group">
                <label for="password_nuevo">Nueva Contraseña:</label>
                <input type="password" id="password_nuevo" name="password_nuevo">
            </div>
            
            <div class="form-group">
                <label for="password_confirmar">Confirmar Nueva Contraseña:</label>
                <input type="password" id="password_confirmar" name="password_confirmar">
            </div>
            
            <button type="submit" class="btn-submit">Guardar Cambios</button>
        </form>

        <div style="margin-top: 20px;">
            <a href="/index.php"><button type="button">Volver al Inicio</button></a>
        </div>
    </div>
</body>
</html> 