<?php
$incidentesPorEstado = $incidentesPorEstado ?? [];
$incidentesPorTipo   = $incidentesPorTipo ?? [];
$codigoEmpleado      = $detalle['codigo_empleado'] ?? $_SESSION['codigo_empleado'] ?? 'N/A';
$nombreAgente        = $detalle['nombres'] ?? $_SESSION['nombre_usuario'] ?? 'Agente';
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
            <p class="welcome-message">Bienvenido, <?php echo htmlspecialchars($nombreAgente); ?></p>
            <p class="user-info-detail">Código : <span><?php echo htmlspecialchars($codigoEmpleado); ?></span></p>
            <a href="index.php?action=logout" class="btn-secondary">Cerrar Sesión</a>
        </header>

        <!-- DASHBOARD BODY -->
        <main class="dashboard-content dashboard-grid-container">
            
            <div class="panel-card">
                <div class="panel-card-header">
                    <h2 class="section-title-clean" style="font-size: 18px; color: #1e293b;">Mis Incidentes Asignados</h2>
                </div>

                <!-- 1. INCIDENTES POR ESTADO -->
                <h3 class="section-title-clean" style="margin: 15px 0 10px 0; font-size: 14px; color: #64748b;">Por Estado</h3>
                <div class="metrics-grid-modern" style="margin-bottom: 25px;">
                    <?php if (!empty($incidentesPorEstado)): ?>
                        <?php foreach ($incidentesPorEstado as $estado): ?>
                            <div class="metric-card-modern">
                                <div class="title"><?php echo htmlspecialchars($estado['estado']); ?></div>
                                <div class="number"><?php echo $estado['total']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="metric-card-modern"><div class="title">Registrado</div><div class="number">0</div></div>
                        <div class="metric-card-modern"><div class="title">En proceso</div><div class="number">0</div></div>
                        <div class="metric-card-modern"><div class="title">Resuelto</div><div class="number">0</div></div>
                        <div class="metric-card-modern"><div class="title">Cerrado</div><div class="number">0</div></div>
                    <?php endif; ?>
                </div>

                <!-- 2. INCIDENTES POR TIPO SOLICITUD -->
                <h3 class="section-title-clean" style="margin: 15px 0 10px 0; font-size: 14px; color: #64748b;">Por Tipo de Solicitud</h3>
                <div class="metrics-grid-modern">
                    <?php if (!empty($incidentesPorTipo)): ?>
                        <?php foreach ($incidentesPorTipo as $tipo): ?>
                            <div class="metric-card-modern">
                                <div class="title"><?php echo htmlspecialchars($tipo['tipo_solicitud']); ?></div>
                                <div class="number"><?php echo $tipo['total']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="metric-card-modern"><div class="title">Incidentes</div><div class="number">0</div></div>
                        <div class="metric-card-modern"><div class="title">Consultas</div><div class="number">0</div></div>
                        <div class="metric-card-modern"><div class="title">Reclamo</div><div class="number">0</div></div>
                        <div class="metric-card-modern"><div class="title">Sugerencias</div><div class="number">0</div></div>
                    <?php endif; ?>
                </div>
            </div>

        </main>

    </div>

</body>
</html>