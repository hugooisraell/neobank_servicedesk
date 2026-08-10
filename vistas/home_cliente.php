<?php
$incidentesPorEstado = $incidentesPorEstado ?? [];
$incidentesPorTipo   = $incidentesPorTipo ?? [];
$cedulaCliente       = $detalle['cedula'] ?? $_SESSION['cedula'] ?? 'N/A';
$nombresCompletos    = isset($detalle['nombres']) ? ($detalle['nombres'] . ' ' . ($detalle['apellidos'] ?? '')) : ($_SESSION['nombre_usuario'] ?? 'Cliente');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEOBANK - Service Desk</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

    <div class="main-container">

        <!-- HEADER INSTITUCIONAL -->
        <header class="header-section">
            <h1 class="brand-title">NEOBANK</h1>
            <p class="brand-subtitle">Service Desk</p>
            <p class="welcome-message">Bienvenido, <?php echo htmlspecialchars($nombresCompletos); ?></p>
            <p class="user-info-detail">Cédula : <span><?php echo htmlspecialchars($cedulaCliente); ?></span></p>
            <a href="index.php?action=logout" class="btn-secondary">Cerrar Sesión</a>
        </header>

        <!-- DASHBOARD BODY -->
        <main class="dashboard-content dashboard-grid-container">

            <div class="panel-card">
                <div class="panel-card-header">
                    <h2 class="section-title-clean" style="font-size: 18px; color: #1e293b;">Mis Incidentes Creados</h2>
                </div>

                <!-- 1. INCIDENTES POR ESTADO -->
                <h3 class="section-title-clean" style="margin: 15px 0 10px 0; font-size: 14px; color: #64748b;">Estado de mis Solicitudes</h3>
                <div class="metrics-grid-modern" style="margin-bottom: 25px;">
                    <?php if (!empty($incidentesPorEstado)): ?>
                        <?php foreach ($incidentesPorEstado as $estado): ?>
                            <a href="index.php?action=verDetalleTarjeta&filtro=estado&valor=<?php echo urlencode($estado['estado']); ?>" style="text-decoration: none;">
                                <div class="metric-card-modern">
                                    <div class="title"><?php echo htmlspecialchars($estado['estado']); ?></div>
                                    <div class="number"><?php echo $estado['total']; ?></div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="metric-card-modern">
                            <div class="title">Sin datos</div>
                            <div class="number">0</div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- 2. INCIDENTES POR TIPO SOLICITUD -->
                <h3 class="section-title-clean" style="margin: 15px 0 10px 0; font-size: 14px; color: #64748b;">Solicitudes por Tipo</h3>
                <div class="metrics-grid-modern">
                    <?php if (!empty($incidentesPorTipo)): ?>
                        <?php foreach ($incidentesPorTipo as $tipo): ?>
                            <a href="index.php?action=verDetalleTarjeta&filtro=tipo&valor=<?php echo urlencode($tipo['tipo_solicitud']); ?>" style="text-decoration: none;">
                                <div class="metric-card-modern">
                                    <div class="title"><?php echo htmlspecialchars($tipo['tipo_solicitud']); ?></div>
                                    <div class="number"><?php echo $tipo['total']; ?></div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="metric-card-modern">
                            <div class="title">Sin datos</div>
                            <div class="number">0</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- BOTÓN DE REGISTRAR INCIDENTES -->
            <div>
                <a href="index.php?action=nuevoIncidente" class="btn-primary" style="padding: 12px 20px;">+ Registrar Incidente</a>
            </div>

        </main>

    </div>

</body>

</html>