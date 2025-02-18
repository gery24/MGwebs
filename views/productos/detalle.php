<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Producto</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h1>Detalle del Producto</h1>
    <?php if ($producto): ?>
        <p><strong>ID:</strong> <?php echo $producto['id']; ?></p>
        <p><strong>Nombre:</strong> <?php echo $producto['nombre']; ?></p>
        <p><strong>Precio:</strong> <?php echo $producto['precio']; ?> €</p>
        <p><strong>Descripción:</strong> <?php echo $producto['descripcion']; ?></p>
        <a href="index.php?action=listado">Volver al Listado</a>
    <?php else: ?>
        <p>Producto no encontrado.</p>
    <?php endif; ?>
</body>
</html>
