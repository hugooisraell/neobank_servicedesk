<?php
// controladores/ControlAut.php

require_once 'modelos/Usuario.php';
require_once 'modelos/Incidente.php';

class ControlAut
{
    private $usuarioModel;
    private $incidenteModel;

    public function __construct(PDO $db)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->usuarioModel = new Usuario($db);
        $this->incidenteModel = new Incidente($db);
    }

    /**
     * Muestra la vista de Login.
     */
    public function mostrarLogin()
    {
        if (isset($_SESSION['id_usuario'])) {
            header('Location: index.php?action=home');
            exit;
        }
        require_once 'vistas/login.php';
    }

    /**
     * Procesa la solicitud POST enviada desde el formulario de login.
     */
    public function procesarLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre_usuario = trim($_POST['nombre_usuario'] ?? '');
            $contrasena = trim($_POST['contrasena'] ?? '');

            if (empty($nombre_usuario) || empty($contrasena)) {
                $error = "Por favor, ingresa tu usuario y contraseña.";
                require_once 'vistas/login.php';
                return;
            }

            // Validar credenciales
            $usuario = $this->usuarioModel->validarCredenciales($nombre_usuario, $contrasena);

            if ($usuario) {
                // Mapear rol a tabla correspondiente (empleado o cliente)
                $rol = strtoupper($usuario['role']);
                $tipo_perfil = ($rol === 'CLIENTE') ? 'cliente' : 'empleado';

                // Obtener datos detallados
                $detalle = $this->usuarioModel->obtenerDetallePorRol($usuario['id_usuario'], $tipo_perfil);

                // Guardar datos en la sesión
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
                $_SESSION['role'] = $rol; // Guardamos "SUPERVISOR", "AGENTE_SOPORTE" o "CLIENTE"
                $_SESSION['detalle'] = $detalle;

                header('Location: index.php?action=home');
                exit;
            } else {
                $error = "Credenciales incorrectas. Inténtalo de nuevo.";
                require_once 'vistas/login.php';
            }
        } else {
            $this->mostrarLogin();
        }
    }

    /**
     * Carga el Home correspondiente según el rol almacenado en sesión.
     */
    public function mostrarHome()
    {
        if (!isset($_SESSION['id_usuario'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $rol = strtoupper(trim($_SESSION['role']));
        $detalle = $_SESSION['detalle'] ?? null;

        switch ($rol) {
            case 'SUPERVISOR':
                // Instanciar e invocar las consultas
                $totalIncidentes         = $this->incidenteModel->contarTotalIncidentes();
                $incidentesSinAsignar    = $this->incidenteModel->contarIncidentesSinAsignar();
                $incidentesPorEstado     = $this->incidenteModel->contarIncidentesPorEstado();
                $incidentesPorTipo       = $this->incidenteModel->contarIncidentesPorTipoSolicitud();

                // Cargar la vista después de haber creado las variables
                require_once 'vistas/home_supervisor.php';
                break;

            case 'AGENTE_SOPORTE':
                // Extraemos el id_empleado de los datos del detalle guardados en sesión
                $id_empleado = $detalle['id_empleado'] ?? null;

                // Solicitamos las métricas filtrando por este agente
                $incidentesPorEstado = $this->incidenteModel->contarIncidentesPorEstado($id_empleado);
                $incidentesPorTipo   = $this->incidenteModel->contarIncidentesPorTipoSolicitud($id_empleado);

                require_once 'vistas/home_agente.php';
                break;

            case 'CLIENTE':
                $id_cliente = $detalle['id_cliente'] ?? null;

                // Solicitamos las métricas filtrando únicamente por este cliente
                $incidentesPorEstado = $this->incidenteModel->contarIncidentesPorEstado(null, $id_cliente);
                $incidentesPorTipo   = $this->incidenteModel->contarIncidentesPorTipoSolicitud(null, $id_cliente);

                require_once 'vistas/home_cliente.php';
                break;

            default:
                require_once 'vistas/home.php';
                break;
        }
    }

    /**
     * Cierra la sesión y redirige al login.
     */
    public function logout()
    {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }
}
