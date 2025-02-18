<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Producto</title>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
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
    <div class="product-detail">
        <?php
        // Aquí se debe obtener el ID del producto desde la URL
        $id_producto = $_GET['id'] ?? null;

        if ($id_producto) {
            // Conectar a la base de datos y obtener los detalles del producto
            require_once __DIR__ . '/../../controllers/ProductoController.php';
            $db = conectarDB();
            $query = $db->prepare("SELECT * FROM producto WHERE id_producto = :id");
            $query->execute(['id' => $id_producto]);
            $producto = $query->fetch(PDO::FETCH_ASSOC);

            if ($producto): ?>
                <h1><?php echo htmlspecialchars($producto['nombre_producto']); ?></h1>
                <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                <p class="producto-precio"><?php echo number_format($producto['precio'], 2); ?> €</p>
                <a href="/index.php" class="btn-submit">Volver a la lista de productos</a>
            <?php else: ?>
                <p>Producto no encontrado.</p>
            <?php endif;
        } else {
            echo "<p>ID de producto no especificado.</p>";
        }
        ?>
    </div>
</body>
</html>
