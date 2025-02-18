<?php
require_once __DIR__ . '/../config/database.php';

function conectarDB() {
    try {
        $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

function login($username, $password) {
    try {
        $db = conectarDB();
        $query = $db->prepare("SELECT id_usuario, nombre, correo, contraseña, rol FROM usuario WHERE correo = :username");
        $query->execute(['username' => $username]);
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        
        if (!$usuario) {
            header('Location: /index.php?page=login&error=No existe ningún usuario con ese correo');
            exit();
        }
        
        if (password_verify($password, $usuario['contraseña'])) {
            session_start();
            $_SESSION['user_id'] = $usuario['id_usuario'];
            $_SESSION['username'] = $usuario['nombre'];
            $_SESSION['role'] = $usuario['rol'];
            
            header('Location: /index.php');
            exit();
        } else {
            header('Location: /index.php?page=login&error=Contraseña incorrecta');
            exit();
        }
    } catch (Exception $e) {
        header('Location: /index.php?page=login&error=Error del sistema');
        exit();
    }
}

function register($username, $email, $password, $confirm_password) {
    try {
        if ($password !== $confirm_password) {
            header('Location: /index.php?page=register&error=Las contraseñas no coinciden');
            exit();
        }

        if (strlen($password) < 6) {
            header('Location: /index.php?page=register&error=La contraseña debe tener al menos 6 caracteres');
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: /index.php?page=register&error=El formato del correo no es válido');
            exit();
        }

        $db = conectarDB();
        
        // Verificar si el correo ya existe
        $query = $db->prepare("SELECT id_usuario FROM usuario WHERE correo = :email");
        $query->execute(['email' => $email]);
        if ($query->fetch()) {
            header('Location: /index.php?page=register&error=El correo ya está registrado');
            exit();
        }

        // Crear nuevo usuario
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = $db->prepare("INSERT INTO usuario (nombre, correo, contraseña, rol) VALUES (:username, :email, :password, 'cliente')");
        $result = $query->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        if ($result) {
            header('Location: /index.php?page=login&success=Usuario registrado correctamente');
            exit();
        } else {
            header('Location: /index.php?page=register&error=Error al crear el usuario');
            exit();
        }
    } catch (Exception $e) {
        header('Location: /index.php?page=register&error=Error del sistema');
        exit();
    }
}

function resetPassword($correo) {
    try {
        $db = conectarDB();
        $query = $db->prepare("SELECT id_usuario FROM usuario WHERE correo = :correo");
        $query->execute(['correo' => $correo]);
        
        if (!$query->fetch()) {
            header('Location: /index.php?page=reset-password&error=No existe ninguna cuenta con ese correo');
            exit();
        }

        $newPassword = generateRandomPassword();
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        $query = $db->prepare("UPDATE usuario SET contraseña = :password WHERE correo = :correo");
        $result = $query->execute([
            'password' => $hashedPassword,
            'correo' => $correo
        ]);

        if ($result) {
            header('Location: /index.php?page=reset-password&success=Tu nueva contraseña es: ' . $newPassword);
            exit();
        } else {
            header('Location: /index.php?page=reset-password&error=Error al restablecer la contraseña');
            exit();
        }
    } catch (Exception $e) {
        header('Location: /index.php?page=reset-password&error=Error del sistema');
        exit();
    }
}

function generateRandomPassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $password;
}

function actualizarPerfil($datos) {
    try {
        $db = conectarDB();
        session_start();
        
        // Verificar contraseña actual si se quiere cambiar la contraseña
        if (!empty($datos['password_nuevo'])) {
            // Verificar que las contraseñas nuevas coincidan
            if ($datos['password_nuevo'] !== $datos['password_confirmar']) {
                header('Location: /index.php?page=perfil&error=Las contraseñas nuevas no coinciden');
                exit();
            }
            
            // Verificar contraseña actual
            $query = $db->prepare("SELECT contraseña FROM usuario WHERE id_usuario = :id");
            $query->execute(['id' => $_SESSION['user_id']]);
            $usuario = $query->fetch(PDO::FETCH_ASSOC);
            
            if (!password_verify($datos['password_actual'], $usuario['contraseña'])) {
                header('Location: /index.php?page=perfil&error=La contraseña actual es incorrecta');
                exit();
            }
            
            // Actualizar nombre y contraseña
            $hashedPassword = password_hash($datos['password_nuevo'], PASSWORD_DEFAULT);
            $query = $db->prepare("UPDATE usuario SET nombre = :nombre, contraseña = :password WHERE id_usuario = :id");
            $result = $query->execute([
                'nombre' => $datos['nombre'],
                'password' => $hashedPassword,
                'id' => $_SESSION['user_id']
            ]);
        } else {
            // Solo actualizar nombre
            $query = $db->prepare("UPDATE usuario SET nombre = :nombre WHERE id_usuario = :id");
            $result = $query->execute([
                'nombre' => $datos['nombre'],
                'id' => $_SESSION['user_id']
            ]);
        }
        
        if ($result) {
            $_SESSION['username'] = $datos['nombre'];
            header('Location: /index.php?page=perfil&success=Perfil actualizado correctamente');
        } else {
            header('Location: /index.php?page=perfil&error=Error al actualizar el perfil');
        }
    } catch (Exception $e) {
        header('Location: /index.php?page=perfil&error=Error del sistema');
    }
}

// Manejo de la petición
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            login($_POST['usuario'], $_POST['password']);
            break;
        case 'register':
            register(
                $_POST['usuario'],
                $_POST['correo'],
                $_POST['password'],
                $_POST['confirm_password']
            );
            break;
        case 'reset-password':
            resetPassword($_POST['correo']);
            break;
        case 'update-profile':
            actualizarPerfil($_POST);
            break;
    }
}
?>