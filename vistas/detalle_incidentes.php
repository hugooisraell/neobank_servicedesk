<?php
$listado = $listado ?? [];
$tituloDetalle = $tituloDetalle ?? 'Detalle de Incidentes';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEOBANK - Detalle de Incidentes</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

    <div class="main-container">

        <!-- HEADER INSTITUCIONAL -->
        <header class="header-section">
            <h1 class="brand-title">NEOBANK</h1>
            <p class="brand-subtitle">Service Desk</p>
            <p class="welcome-message"><?php echo htmlspecialchars($tituloDetalle); ?></p>
            <a href="index.php?action=home" class="btn-secondary">← Volver al Dashboard</a>
        </header>

        <!-- CUERPO DE LA VISTA -->
        <main class="dashboard-content">
            <div class="panel-card">

                <p style="font-size: 14px; color: #64748b; margin-bottom: 15px;">
                    Se encontraron <strong><?php echo count($listado); ?></strong> incidente(s) asociados a este indicador.
                </p>

                <?php if (!empty($listado)): ?>
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Cliente</th>
                                    <th>Asunto</th>
                                    <th>Tipo Solicitud</th>
                                    <th>Estado</th>
                                    <th>Agente Asignado</th>
                                    <th>Fecha Registro</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listado as $fila): ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($fila['codigo_incidente']); ?></strong></td>
                                        <td><?php echo htmlspecialchars($fila['cliente']); ?></td>
                                        <td><?php echo htmlspecialchars($fila['asunto']); ?></td>
                                        <td><?php echo htmlspecialchars($fila['tipo_solicitud']); ?></td>
                                        <td><span class="status-badge"><?php echo htmlspecialchars($fila['estado']); ?></span></td>
                                        <td><?php echo htmlspecialchars($fila['agente_asignado'] ?? 'Sin asignar'); ?></td>
                                        <td><?php echo htmlspecialchars($fila['fecha_creacion']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p style="color: #64748b; font-size: 14px; text-align: center; padding: 20px 0;">
                        No existen registros para la tarjeta seleccionada.
                    </p>
                <?php endif; ?>

            </div>
        </main>

    </div>

</body>

</html>