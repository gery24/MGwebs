<?php
class UsuarioModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Obtiene un usuario por su nombre de usuario
    public function getUsuarioByUsername($username) {
        try {
            $query = $this->db->prepare("SELECT id_usuario, nombre, correo, contraseña, rol FROM usuario WHERE correo = :username");
            $query->execute(['username' => $username]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Comprueba si un usuario es administrador
    public function esAdmin($userId) {
        $query = $this->db->prepare("SELECT rol FROM usuario WHERE id_usuario = :id");
        $query->execute(['id' => $userId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['rol'] === 'administrador';
    }

    public function createUser($username, $email, $password) {
        try {
            // Verificar si el usuario ya existe (por correo)
            $checkUser = $this->getUserByEmail($email);
            if ($checkUser) {
                return ['success' => false, 'error' => 'El correo ya está registrado'];
            }

            // Hash de la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Insertar nuevo usuario
            $query = $this->db->prepare("INSERT INTO usuario (nombre, correo, contraseña, direccion_envio, rol) 
                                       VALUES (:username, :email, :password, '', 'cliente')");
            $result = $query->execute([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword
            ]);
            
            if (!$result) {
                error_log("Error al crear usuario: La consulta no se ejecutó correctamente");
                return ['success' => false, 'error' => 'Error al crear el usuario'];
            }
            
            return ['success' => true];
        } catch (PDOException $e) {
            error_log("Error en createUser: " . $e->getMessage());
            return ['success' => false, 'error' => 'Error del sistema'];
        }
    }

    public function updatePassword($correo, $newPassword) {
        try {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = $this->db->prepare("UPDATE usuario SET contraseña = :password WHERE correo = :correo");
            return $query->execute([
                'password' => $hashedPassword,
                'correo' => $correo
            ]);
        } catch (PDOException $e) {
            error_log("Error en updatePassword: " . $e->getMessage());
            return false;
        }
    }

    public function getUserByEmail($correo) {
        try {
            $query = $this->db->prepare("SELECT id_usuario, nombre, correo FROM usuario WHERE correo = :correo");
            $query->execute(['correo' => $correo]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en getUserByEmail: " . $e->getMessage());
            return false;
        }
    }
}
?>
