<?php

// config/conexion.php

$host = 'localhost';
$db   = 'neobank_servicedesk';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // Mensaje de confirmacion
    // echo "Conexion Exitosa ;)";
} catch (\PDOException $e) {
    // Lanza la excepcion
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
    // Muestra el error crudo
    //die("Error de conexión a la base de datos: " . $e->getMessage());
}
