<?php
$totalIncidentes         = $totalIncidentes ?? 0;
$incidentesSinAsignar    = $incidentesSinAsignar ?? 0;
$incidentesPorEstado     = $incidentesPorEstado ?? [];
$incidentesPorTipo       = $incidentesPorTipo ?? [];
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
            <p class="welcome-message">Bienvenido, Supervisor <?php echo htmlspecialchars($detalle['nombres'] ?? $_SESSION['nombre_usuario']); ?></p>
            <a href="index.php?action=logout" class="btn-secondary">Cerrar Sesión</a>
        </header>

        <!-- DASHBOARD BODY -->
        <main class="dashboard-content dashboard-grid-container">
            
            <!-- 1. RESUMEN GENERAL -->
            <div class="panel-card">
                <div class="panel-card-header">
                    <h2 class="section-title-clean">Resumen General de Incidentes</h2>
                </div>
                <div class="metrics-grid-modern">
                    <div class="metric-card-modern metric-card-highlight">
                        <div class="title">Total en sistema</div>
                        <div class="number"><?php echo $totalIncidentes; ?></div>
                    </div>
                    <div class="metric-card-modern metric-card-highlight">
                        <div class="title">Sin Agente Asignado</div>
                        <div class="number"><?php echo $incidentesSinAsignar; ?></div>
                    </div>
                </div>
            </div>

            <!-- 2. INCIDENTES POR ESTADO -->
            <div class="panel-card">
                <div class="panel-card-header">
                    <h2 class="section-title-clean">Incidentes por Estado</h2>
                </div>
                <div class="metrics-grid-modern">
                    <?php if (!empty($incidentesPorEstado)): ?>
                        <?php foreach ($incidentesPorEstado as $estado): ?>
                            <div class="metric-card-modern">
                                <div class="title"><?php echo htmlspecialchars($estado['estado']); ?></div>
                                <div class="number"><?php echo $estado['total']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #64748b; font-size: 14px;">No hay datos disponibles.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- 3. INCIDENTES POR TIPO SOLICITUD -->
            <div class="panel-card">
                <div class="panel-card-header">
                    <h2 class="section-title-clean">Incidentes por Tipo Solicitud</h2>
                </div>
                <div class="metrics-grid-modern">
                    <?php if (!empty($incidentesPorTipo)): ?>
                        <?php foreach ($incidentesPorTipo as $tipo): ?>
                            <div class="metric-card-modern">
                                <div class="title"><?php echo htmlspecialchars($tipo['tipo_solicitud']); ?></div>
                                <div class="number"><?php echo $tipo['total']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #64748b; font-size: 14px;">No hay datos disponibles.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- BOTÓN DE REPORTES -->
            <div>
                <a href="index.php?action=reporteAtencion" class="btn-primary" style="padding: 12px 20px;">+ Generar Reportes</a>
            </div>

        </main>

    </div>

</body>
</html>