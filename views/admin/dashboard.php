<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <style>
        .admin-panel {
            padding: 20px;
        }
        .admin-actions {
            margin: 20px 0;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .product-table th, .product-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .product-table th {
            background-color: #f4f4f4;
        }
        .btn-add {
            background-color: #064111;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-edit {
            background-color: #2196F3;
            color: white;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
        }
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
                    <img src="/public/assets/img/logo.png" alt="MG Logo">
                </a>
            </div>
        </div>
    </div>
    <div class="admin-panel">
        <h1>Panel de Administración</h1>
        
        <div class="admin-actions">
            <a href="?page=admin&action=add-product"><button class="btn-add">Agregar Nuevo Producto</button></a>
        </div>

        <h2>Listado de Productos</h2>
        <table class="product-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($producto['id_producto']); ?></td>
                    <td><?php echo htmlspecialchars($producto['nombre_producto']); ?></td>
                    <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                    <td><?php echo number_format($producto['precio'], 2); ?> €</td>
                    <td>
                        <a href="?page=admin&action=edit-product&id=<?php echo $producto['id_producto']; ?>">
                            <button class="btn-edit">Editar</button>
                        </a>
                        <a href="?page=admin&action=delete-product&id=<?php echo $producto['id_producto']; ?>" 
                           onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?')">
                            <button class="btn-delete">Eliminar</button>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            <a href="/index.php"><button type="button">Volver al Inicio</button></a>
        </div>
    </div>
</body>
</html> 