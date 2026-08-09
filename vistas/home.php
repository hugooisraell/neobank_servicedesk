<h2>Bienvenido, <?php echo htmlspecialchars($detalle['nombres'] ?? $_SESSION['nombre_usuario']); ?></h2>
<a href="index.php?action=logout">Cerrar Sesión</a>