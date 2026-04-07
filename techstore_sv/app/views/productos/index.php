<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div>
        <h2>Gestión de Productos</h2>
        <p class="subtitle">Administre el inventario de productos</p>
    </div>
    <a href="index.php?ruta=productos.crear" class="btn btn-success">
        Nuevo Producto
    </a>
</div>

<?php if (isset($_GET['ok'])): ?>
    <?php if ($_GET['ok'] == 'creado'): ?>
        <div class="alert alert-success">Producto creado exitosamente</div>
    <?php elseif ($_GET['ok'] == 'editado'): ?>
        <div class="alert alert-success">Producto actualizado exitosamente</div>
    <?php elseif ($_GET['ok'] == 'eliminado'): ?>
        <div class="alert alert-success">Producto eliminado exitosamente</div>
    <?php endif; ?>
<?php endif; ?>

<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($productos)): ?>
                <tr>
                    <td colspan="5" class="text-center">No hay productos registrados</td>
                </tr>
            <?php else: ?>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo $producto['id']; ?></td>
                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                    <td class="precio">$<?php echo number_format($producto['precio'], 2); ?></td>
                    <td class="<?php echo $producto['stock'] <= 5 ? 'stock-critico' : ''; ?>">
                        <?php echo $producto['stock']; ?>
                        <?php if ($producto['stock'] <= 5): ?>
                            <span class="stock-badge">Stock bajo</span>
                        <?php endif; ?>
                    </td>
                    <td class="acciones">
                        <a href="index.php?ruta=productos.editar&id=<?php echo $producto['id']; ?>" 
                           class="btn-edit">Editar</a>
                        <a href="index.php?ruta=productos.eliminar&id=<?php echo $producto['id']; ?>" 
                           class="btn-delete" 
                           onclick="return confirm('¿Está seguro de eliminar este producto?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>