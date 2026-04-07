<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStore SV - Sistema de Gestión de Inventario</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="app-container">
        <?php if (!empty($_SESSION['usuario'])): ?>
        <nav class="navbar">
            <div class="nav-brand">
                <div class="logo">TechStore SV</div>
                <div class="logo-subtitle">Sistema de Gestión de Inventario</div>
            </div>
            <div class="nav-menu">
                <span class="user-info">Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                <a href="index.php?ruta=productos" class="nav-link">Productos</a>
                <a href="index.php?ruta=logout" class="nav-link logout">Cerrar Sesión</a>
            </div>
        </nav>
        <?php endif; ?>
        
        <main class="main-content">