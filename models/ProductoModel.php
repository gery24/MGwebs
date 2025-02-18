<?php
class ProductoModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerTodosLosProductos() {
        try {
            $query = $this->db->prepare("SELECT id_producto, nombre_producto, descripcion, precio FROM producto");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener los productos: " . $e->getMessage());
        }
    }

    public function obtenerProductoPorId($id) {
        try {
            $query = $this->db->prepare("SELECT * FROM producto WHERE id_producto = :id");
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener el producto: " . $e->getMessage());
        }
    }

    public function agregarProducto($nombre, $descripcion, $precio) {
        try {
            $query = $this->db->prepare("INSERT INTO producto (nombre_producto, descripcion, precio) VALUES (:nombre, :descripcion, :precio)");
            return $query->execute([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'precio' => $precio
            ]);
        } catch (PDOException $e) {
            throw new Exception("Error al agregar el producto: " . $e->getMessage());
        }
    }

    public function actualizarProducto($id, $nombre, $descripcion, $precio) {
        try {
            $query = $this->db->prepare("UPDATE producto SET nombre_producto = :nombre, descripcion = :descripcion, precio = :precio WHERE id_producto = :id");
            return $query->execute([
                'id' => $id,
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'precio' => $precio
            ]);
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar el producto: " . $e->getMessage());
        }
    }

    public function eliminarProducto($id) {
        try {
            $query = $this->db->prepare("DELETE FROM producto WHERE id_producto = :id");
            return $query->execute(['id' => $id]);
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar el producto: " . $e->getMessage());
        }
    }
}
?>