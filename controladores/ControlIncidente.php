<?php
// controladores/ControlIncidente.php

require_once 'modelos/Incidente.php';

class ControlIncidente
{
    private $incidenteModel;

    public function __construct(PDO $db)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->incidenteModel = new Incidente($db);
    }

    /**
     * Muestra el formulario para registrar un incidente.
     */
    public function mostrarFormulario()
    {
        // Validar que el usuario tenga sesión activa y sea CLIENTE
        if (!isset($_SESSION['id_usuario']) || $_SESSION['role'] !== 'CLIENTE') {
            header('Location: index.php?action=login');
            exit;
        }

        $detalle = $_SESSION['detalle'];
        $tiposSolicitud = $this->incidenteModel->obtenerTiposSolicitud();

        // Generar un código único de incidente (ejemplo: INC-8493)
        $codigo_incidente = 'INC-' . strtoupper(substr(uniqid(), -5));

        require_once 'vistas/crear_incidente.php';
    }

    /**
     * Procesa la inserción del incidente.
     */
    public function guardar()
    {
        if (!isset($_SESSION['id_usuario']) || $_SESSION['role'] !== 'CLIENTE') {
            header('Location: index.php?action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $asunto = trim($_POST['asunto'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $id_tipo_solicitud = $_POST['id_tipo_solicitud'] ?? null;
            $id_cliente = $_SESSION['detalle']['id_cliente'] ?? null;

            if (empty($asunto) || empty($descripcion) || empty($id_tipo_solicitud)) {
                $error = "Todos los campos son obligatorios.";
                $tiposSolicitud = $this->incidenteModel->obtenerTiposSolicitud();
                require_once 'vistas/crear_incidente.php';
                return;
            }

            // Recibe el código del formulario o genera uno de respaldo
            $codigo_incidente = $_POST['codigo_incidente'] ?? ('INC-' . strtoupper(substr(uniqid(), -5)));

            $exito = $this->incidenteModel->crearIncidente($codigo_incidente, $asunto, $descripcion, $id_cliente, $id_tipo_solicitud);

            if ($exito) {
                header('Location: index.php?action=home&msg=incidente_creado');
                exit;
            } else {
                $error = "Ocurrió un error al registrar el incidente. Inténtalo de nuevo.";
                $tiposSolicitud = $this->incidenteModel->obtenerTiposSolicitud();
                require_once 'vistas/crear_incidente.php';
            }
        }
    }

    /**
     * Muestra la vista de reportes para el supervisor.
     */
    public function mostrarReporteSupervisor()
    {
        if (!isset($_SESSION['id_usuario']) || $_SESSION['role'] !== 'SUPERVISOR') {
            header('Location: index.php?action=login');
            exit;
        }

        $empleados = $this->incidenteModel->obtenerListaEmpleados();
        $reporte = null;
        $empleadoSeleccionado = $_GET['id_empleado'] ?? '';
        $fechaSeleccionada = $_GET['fecha'] ?? '';

        // Si el supervisor envió el filtro por GET
        if (!empty($empleadoSeleccionado) && !empty($fechaSeleccionada)) {
            $reporte = $this->incidenteModel->obtenerReporteAtencionEmpleado($empleadoSeleccionado, $fechaSeleccionada);
        }

        require_once 'vistas/reporte_atencion.php';
    }

    /**
     * Muestra la lista detallada al hacer clic en una tarjeta del Dashboard.
     */
    public function verDetalleTarjeta()
    {
        if (!isset($_SESSION['id_usuario'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $filtro = $_GET['filtro'] ?? 'todos';
        $valor  = $_GET['valor'] ?? null;
        $role   = $_SESSION['role'];

        $id_empleado = ($role === 'AGENTE_SOPORTE') ? ($_SESSION['detalle']['id_empleado'] ?? null) : null;
        $id_cliente  = ($role === 'CLIENTE') ? ($_SESSION['detalle']['id_cliente'] ?? null) : null;

        $listado = $this->incidenteModel->obtenerIncidentesPorFiltro($filtro, $valor, $id_empleado, $id_cliente);
        $tituloDetalle = $this->generarTituloDetalle($filtro, $valor);

        require_once 'vistas/detalle_incidentes.php';
    }

    private function generarTituloDetalle($filtro, $valor)
    {
        if ($filtro === 'sin_asignar') return "Incidentes Sin Agente Asignado";
        if ($filtro === 'estado') return "Incidentes en Estado: " . htmlspecialchars($valor);
        if ($filtro === 'tipo') return "Solicitudes de Tipo: " . htmlspecialchars($valor);
        return "Listado Total de Incidentes";
    }
}
