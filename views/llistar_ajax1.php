<?php
try {
    // Devolver el mensaje como texto (para AJAX)
    if ($mensaje) {
        echo $mensaje['mensaje']; // Mostramos el mensaje en respuesta
    } else {
        echo 'No se encontró ningún mensaje con ID 3.';
    }
} catch (Exception $e) {
    echo 'Error al realizar la consulta: ' . $e->getMessage();
}
?>