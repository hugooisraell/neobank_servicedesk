<?php
$detalle = $_SESSION['detalle'] ?? [];
$tiposSolicitud = $tiposSolicitud ?? [];
$codigo_incidente = $codigo_incidente ?? ('INC-' . strtoupper(substr(uniqid(), -5)));
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEOBANK - Registrar Incidente</title>
    <!-- Vinculación del CSS general -->
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

    <div class="main-container">

        <!-- HEADER INSTITUCIONAL -->
        <header class="header-section">
            <h1 class="brand-title">NEOBANK</h1>
            <p class="brand-subtitle">Service Desk</p>
            <p class="welcome-message">Registrar Nuevo Incidente</p>
            <a href="index.php?action=home" class="btn-secondary">← Volver al Panel Principal</a>
        </header>

        <!-- CUERPO DE LA VISTA -->
        <main class="dashboard-content">

            <?php if (isset($error)): ?>
                <div class="error-alert" style="margin-bottom: 20px;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="index.php?action=guardarIncidente" method="POST">

                <!-- 1. INFORMACIÓN DEL CLIENTE -->
                <div class="panel-card">
                    <h2 class="section-title">Información del Cliente</h2>

                    <div class="info-display-grid">
                        <div class="info-item">
                            <strong>Nombres:</strong>
                            <?php echo htmlspecialchars($detalle['nombres'] ?? ''); ?>
                        </div>
                        <div class="info-item">
                            <strong>Apellidos:</strong>
                            <?php echo htmlspecialchars($detalle['apellidos'] ?? ''); ?>
                        </div>
                        <div class="info-item">
                            <strong>Cédula:</strong>
                            <?php echo htmlspecialchars($detalle['cedula'] ?? 'N/A'); ?>
                        </div>
                        <div class="info-item">
                            <strong>Teléfono:</strong>
                            <?php echo htmlspecialchars($detalle['telefono'] ?? 'N/A'); ?>
                        </div>
                        <div class="info-item" style="grid-column: span 2;">
                            <strong>Correo Electrónico:</strong>
                            <?php echo htmlspecialchars($detalle['email'] ?? 'N/A'); ?>
                        </div>
                    </div>
                </div>

                <!-- 2. INFORMACIÓN DEL INCIDENTE -->
                <div class="panel-card">
                    <h2 class="section-title">Información del Incidente</h2>

                    <!-- Número de Incidente Generado -->
                    <div class="form-group-block">
                        <label for="codigo_incidente">Número de Incidente:</label>
                        <input type="text" id="codigo_incidente" name="codigo_incidente" class="form-control form-input-readonly" value="<?php echo htmlspecialchars($codigo_incidente); ?>" readonly>
                    </div>

                    <!-- Tipo de Solicitud -->
                    <div class="form-group-block">
                        <label for="id_tipo_solicitud">Tipo de Solicitud:</label>
                        <select name="id_tipo_solicitud" id="id_tipo_solicitud" class="form-control" required>
                            <option value="">-- Seleccione un tipo --</option>
                            <?php foreach ($tiposSolicitud as $tipo): ?>
                                <option value="<?php echo $tipo['id_tipo_solicitud']; ?>">
                                    <?php echo htmlspecialchars($tipo['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Asunto del Incidente -->
                    <div class="form-group-block">
                        <label for="asunto">Asunto del Incidente:</label>
                        <input type="text" name="asunto" id="asunto" class="form-control" placeholder="Ej: Error al realizar una transferencia" required autocomplete="off">
                    </div>

                    <!-- Descripción del Incidente -->
                    <div class="form-group-block">
                        <label for="descripcion">Descripción del Incidente:</label>
                        <textarea name="descripcion" id="descripcion" class="form-control form-textarea" placeholder="Detalle lo sucedido lo más claro posible..." required></textarea>
                    </div>

                </div>

                <!-- ACCIONES -->
                <div style="margin-top: 10px;">
                    <button type="submit" class="btn-primary" style="padding: 12px 24px; font-size: 15px;">
                        Guardar e Incidenciar
                    </button>
                </div>

            </form>

        </main>

    </div>

</body>

</html>