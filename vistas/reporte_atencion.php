<?php
$empleados = $empleados ?? [];
$reporte = $reporte ?? null;
$empleadoSeleccionado = $empleadoSeleccionado ?? '';
$fechaSeleccionada = $fechaSeleccionada ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEOBANK - Reporte de Atenciones</title>
    <!-- Vinculación del CSS general -->
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <div class="main-container">
        
        <!-- HEADER INSTITUCIONAL -->
        <header class="header-section">
            <h1 class="brand-title">NEOBANK</h1>
            <p class="brand-subtitle">Service Desk</p>
            <p class="welcome-message">Reporte de Clientes Atendidos</p>
            <a href="index.php?action=home" class="btn-secondary">← Volver al Panel Principal</a>
        </header>

        <!-- CUERPO DE LA VISTA -->
        <main class="dashboard-content">
            <div class="panel-card">
                
                <h2 class="section-title">Filtros de Búsqueda</h2>

                <!-- Formulario de Filtro -->
                <form action="index.php" method="GET" class="filter-form">
                    <input type="hidden" name="action" value="reporteAtencion">

                    <div class="form-group-inline">
                        <label for="id_empleado">Empleado / Agente:</label>
                        <select name="id_empleado" id="id_empleado" class="form-control" required>
                            <option value="">-- Seleccione un Empleado --</option>
                            <?php foreach ($empleados as $emp): ?>
                                <option value="<?php echo $emp['id_empleado']; ?>" <?php echo ($empleadoSeleccionado == $emp['id_empleado']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($emp['nombre_completo'] . ' (' . $emp['cargo'] . ')'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group-inline">
                        <label for="fecha">Fecha:</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo htmlspecialchars($fechaSeleccionada); ?>" required>
                    </div>

                    <button type="submit" class="btn-primary">Generar Reporte</button>
                </form>

            </div>

            <!-- RESULTADOS DEL REPORTE -->
            <?php if ($reporte !== null): ?>
                <div class="panel-card">
                    <h2 class="section-title">Resultados del Reporte</h2>

                    <?php if (!empty($reporte)): ?>
                        <p style="font-size: 14px; color: #64748b; margin-bottom: 15px;">
                            Se encontraron <strong><?php echo count($reporte); ?></strong> registro(s) para la fecha seleccionada.
                        </p>
                        
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Cliente</th>
                                        <th>Cédula</th>
                                        <th>Contacto</th>
                                        <th>Asunto</th>
                                        <th>Tipo Solicitud</th>
                                        <th>Estado</th>
                                        <th>Fecha Creación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($reporte as $fila): ?>
                                        <tr>
                                            <td><strong><?php echo htmlspecialchars($fila['codigo_incidente']); ?></strong></td>
                                            <td><?php echo htmlspecialchars($fila['nombre_cliente']); ?></td>
                                            <td><?php echo htmlspecialchars($fila['cedula']); ?></td>
                                            <td>
                                                <?php echo htmlspecialchars($fila['email_cliente']); ?><br>
                                                <small style="color: #64748b;"><?php echo htmlspecialchars($fila['telefono_cliente']); ?></small>
                                            </td>
                                            <td><?php echo htmlspecialchars($fila['asunto']); ?></td>
                                            <td><?php echo htmlspecialchars($fila['tipo_solicitud']); ?></td>
                                            <td><span class="status-badge"><?php echo htmlspecialchars($fila['estado']); ?></span></td>
                                            <td><?php echo htmlspecialchars($fila['fecha_creacion']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p style="color: #64748b; font-size: 14px; text-align: center; padding: 20px 0;">
                            No se encontraron clientes o incidentes atendidos por este empleado en la fecha elegida.
                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </main>

    </div>

</body>
</html>