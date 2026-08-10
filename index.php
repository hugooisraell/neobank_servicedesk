<?php
// index.php

// Incluye el archivo de conexion y el controlador de autentificacion
require_once 'config/conexion.php';
require_once 'controladores/ControlAut.php';
require_once 'controladores/ControlIncidente.php';

$db = $pdo;
$action = $_GET['action'] ?? 'login';

$controller = new ControlAut($db);
$incidenteController = new ControlIncidente($db);
$incidenteController = new ControlIncidente($db);

switch ($action) {
    case 'login':
        $controller->mostrarLogin(); // muestra el login
        break;

    case 'procesarLogin':
        $controller->procesarLogin(); // valida los datos de sesion
        break;

    case 'home':
        $controller->mostrarHome(); // muestra el home
        break;

    case 'logout':
        $controller->logout(); // cerrar sesion
        break;

    case 'nuevoIncidente':
        $incidenteController->mostrarFormulario(); // muestra formulario para nuevo incidente
        break;

    case 'guardarIncidente':
        $incidenteController->guardar(); // guarda datos de nuevo incidente
        break;

    case 'reporteAtencion':
        $incidenteController->mostrarReporteSupervisor(); // genera reportes de atencion
        break;

    case 'verDetalleTarjeta':
        $incidenteController->verDetalleTarjeta(); // muestra el contenido detallado de la tarjeta
        break;

    default:
        $controller->mostrarLogin();
        break;
}
