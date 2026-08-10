<?php
// modelos/Incidente.php

class Incidente
{
    private $db;

    public function __construct(PDO $conexion)
    {
        $this->db = $conexion;
    }

    /**
     * Obtiene incidentes por estado.
     * Admite filtrado opcional por $id_empleado o $id_cliente.
     */
    public function contarIncidentesPorEstado($id_empleado = null, $id_cliente = null)
    {
        if ($id_empleado !== null) {
            $sql = "SELECT e.nombre AS estado, COUNT(i.id_incidente) AS total
                    FROM estado_incidente e
                    LEFT JOIN incidente i ON e.id_estado = i.id_estado AND i.id_empleado = :id_empleado
                    GROUP BY e.id_estado, e.nombre";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_empleado' => $id_empleado]);
            return $stmt->fetchAll();
        } elseif ($id_cliente !== null) {
            $sql = "SELECT e.nombre AS estado, COUNT(i.id_incidente) AS total
                    FROM estado_incidente e
                    LEFT JOIN incidente i ON e.id_estado = i.id_estado AND i.id_cliente = :id_cliente
                    GROUP BY e.id_estado, e.nombre";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_cliente' => $id_cliente]);
            return $stmt->fetchAll();
        } else {
            $sql = "SELECT e.nombre AS estado, COUNT(i.id_incidente) AS total
                    FROM estado_incidente e
                    LEFT JOIN incidente i ON e.id_estado = i.id_estado
                    GROUP BY e.id_estado, e.nombre";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        }
    }

    /**
     * Obtiene incidentes por tipo de solicitud.
     * Admite filtrado opcional por $id_empleado o $id_cliente.
     */
    public function contarIncidentesPorTipoSolicitud($id_empleado = null, $id_cliente = null)
    {
        if ($id_empleado !== null) {
            $sql = "SELECT t.nombre AS tipo_solicitud, COUNT(i.id_incidente) AS total
                    FROM tipo_solicitud t
                    LEFT JOIN incidente i ON t.id_tipo_solicitud = i.id_tipo_solicitud AND i.id_empleado = :id_empleado
                    GROUP BY t.id_tipo_solicitud, t.nombre";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_empleado' => $id_empleado]);
            return $stmt->fetchAll();
        } elseif ($id_cliente !== null) {
            $sql = "SELECT t.nombre AS tipo_solicitud, COUNT(i.id_incidente) AS total
                    FROM tipo_solicitud t
                    LEFT JOIN incidente i ON t.id_tipo_solicitud = i.id_tipo_solicitud AND i.id_cliente = :id_cliente
                    GROUP BY t.id_tipo_solicitud, t.nombre";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_cliente' => $id_cliente]);
            return $stmt->fetchAll();
        } else {
            $sql = "SELECT t.nombre AS tipo_solicitud, COUNT(i.id_incidente) AS total
                    FROM tipo_solicitud t
                    LEFT JOIN incidente i ON t.id_tipo_solicitud = i.id_tipo_solicitud
                    GROUP BY t.id_tipo_solicitud, t.nombre";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        }
    }

    /**
     * Obtiene el número total de incidentes registrados en el sistema.
     */
    public function contarTotalIncidentes()
    {
        $sql = "SELECT COUNT(*) AS total FROM incidente";
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetch();
        return $resultado ? (int)$resultado['total'] : 0;
    }

    /**
     * Cuenta los incidentes que aún no han sido asignados a ningún agente (id_empleado es NULL).
     */
    public function contarIncidentesSinAsignar()
    {
        $sql = "SELECT COUNT(*) AS total FROM incidente WHERE id_empleado IS NULL";
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetch();
        return $resultado ? (int)$resultado['total'] : 0;
    }

    /**
     * Obtiene todos los tipos de solicitud para cargarlos en el formulario.
     */
    public function obtenerTiposSolicitud()
    {
        $sql = "SELECT id_tipo_solicitud, nombre FROM tipo_solicitud ORDER BY nombre ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Registra un nuevo incidente en la base de datos.
     */
    public function crearIncidente($codigo, $asunto, $descripcion, $id_cliente, $id_tipo_solicitud)
    {
        // Por defecto, un nuevo incidente ingresa con el estado inicial (ej. id_estado = 1: Abierto/Pendiente)
        // Y sin agente asignado (id_empleado = NULL)
        $id_estado_inicial = 1;

        $sql = "INSERT INTO incidente (codigo_incidente, asunto, descripcion, fecha_creacion, id_cliente, id_tipo_solicitud, id_estado) 
                VALUES (:codigo, :asunto, :descripcion, NOW(), :id_cliente, :id_tipo, :id_estado)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':codigo'     => $codigo,
            ':asunto'     => $asunto,
            ':descripcion' => $descripcion,
            ':id_cliente' => $id_cliente,
            ':id_tipo'    => $id_tipo_solicitud,
            ':id_estado'  => $id_estado_inicial
        ]);
    }

    /**
     * Obtiene el reporte de incidentes/clientes atendidos por un empleado en una fecha específica.
     */
    public function obtenerReporteAtencionEmpleado($id_empleado, $fecha)
    {
        $sql = "SELECT 
                    i.codigo_incidente,
                    i.asunto,
                    i.fecha_creacion,
                    i.fecha_cierre,
                    c.cedula,
                    CONCAT(c.nombres, ' ', c.apellidos) AS nombre_cliente,
                    c.email AS email_cliente,
                    c.telefono AS telefono_cliente,
                    e.nombre AS estado,
                    t.nombre AS tipo_solicitud
                FROM incidente i
                INNER JOIN cliente c ON i.id_cliente = c.id_cliente
                INNER JOIN estado_incidente e ON i.id_estado = e.id_estado
                INNER JOIN tipo_solicitud t ON i.id_tipo_solicitud = t.id_tipo_solicitud
                WHERE i.id_empleado = :id_empleado 
                  AND DATE(i.fecha_creacion) = :fecha
                ORDER BY i.fecha_creacion DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_empleado' => $id_empleado,
            ':fecha'       => $fecha
        ]);

        return $stmt->fetchAll();
    }

    /**
     * Obtiene la lista de todos los empleados (agentes/supervisores) para el desplegable del reporte.
     */
    public function obtenerListaEmpleados()
    {
        $sql = "SELECT id_empleado, codigo_empleado, CONCAT(nombres, ' ', apellidos) AS nombre_completo, cargo 
                FROM empleado 
                ORDER BY nombres ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene el listado de incidentes aplicando filtros desde las tarjetas del Dashboard.
     */
    public function obtenerIncidentesPorFiltro($filtro, $valor = null, $id_empleado = null, $id_cliente = null)
    {
        $sql = "SELECT 
                    i.codigo_incidente,
                    i.asunto,
                    i.descripcion,
                    i.fecha_creacion,
                    CONCAT(c.nombres, ' ', c.apellidos) AS cliente,
                    e.nombre AS estado,
                    t.nombre AS tipo_solicitud,
                    CONCAT(emp.nombres, ' ', emp.apellidos) AS agente_asignado
                FROM incidente i
                INNER JOIN cliente c ON i.id_cliente = c.id_cliente
                INNER JOIN estado_incidente e ON i.id_estado = e.id_estado
                INNER JOIN tipo_solicitud t ON i.id_tipo_solicitud = t.id_tipo_solicitud
                LEFT JOIN empleado emp ON i.id_empleado = emp.id_empleado
                WHERE 1=1";

        $params = [];

        // Filtro de contexto según el rol
        if ($id_empleado !== null) {
            $sql .= " AND i.id_empleado = :id_empleado";
            $params[':id_empleado'] = $id_empleado;
        }

        if ($id_cliente !== null) {
            $sql .= " AND i.id_cliente = :id_cliente";
            $params[':id_cliente'] = $id_cliente;
        }

        // Filtros específicos según la tarjeta presionada
        if ($filtro === 'sin_asignar') {
            $sql .= " AND i.id_empleado IS NULL";
        } elseif ($filtro === 'estado' && $valor !== null) {
            $sql .= " AND e.nombre = :valor";
            $params[':valor'] = $valor;
        } elseif ($filtro === 'tipo' && $valor !== null) {
            $sql .= " AND t.nombre = :valor";
            $params[':valor'] = $valor;
        }

        $sql .= " ORDER BY i.fecha_creacion DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
