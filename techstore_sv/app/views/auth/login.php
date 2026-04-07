<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h1>TechStore SV</h1>
            <p>Ingrese sus credenciales para acceder al sistema</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error">
                Acceso denegado. Debe iniciar sesión primero.
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?ruta=login" class="login-form">
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" 
                       placeholder="Ingrese su usuario" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" 
                       placeholder="Ingrese su contraseña" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                Iniciar Sesión
            </button>
        </form>

        <div class="login-footer">
            <small>Sistema de Gestión de Inventario - TechStore SV</small>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>