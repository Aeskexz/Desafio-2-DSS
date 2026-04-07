<?php
// app/views/productos/editar.php

// Verificar que $producto existe y es array
if (!isset($producto) || !is_array($producto)) {
    die("Error: Producto no válido");
}
?>

<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2>✏️ Editar Producto</h2>
            <a href="index.php?ruta=productos" class="btn-back">← Volver</a>
        </div>

        <?php if (!empty($errores)): ?>
            <div class="alert alert-error">
                <?php foreach ($errores as $error): ?>
                    <p>⚠️ <?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?ruta=productos.editar&id=<?php echo $producto['id']; ?>" 
              class="producto-form">
            <div class="form-group">
                <label for="nombre">Nombre del producto *</label>
                <input type="text" id="nombre" name="nombre" 
                       value="<?php echo htmlspecialchars($producto['nombre']); ?>"
                       required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="precio">Precio ($) *</label>
                    <input type="number" id="precio" name="precio" step="0.01" min="0"
                           value="<?php echo htmlspecialchars($producto['precio']); ?>"
                           required>
                </div>

                <div class="form-group">
                    <label for="stock">Stock *</label>
                    <input type="number" id="stock" name="stock" min="0"
                           value="<?php echo htmlspecialchars($producto['stock']); ?>"
                           required>
                </div>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">💾 Actualizar Producto</button>
                <a href="index.php?ruta=productos" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>