<?php
// Incluir el archivo de conexión
require_once 'conexion.php'; // o 'config/conexion.php' según la estructura de tu carpeta

/**
 * Bloque de codigo para actualizar todas las claves de usuario de la base de datos
 * El proposito es tener una sola clave para todos los usuarios y 
 * facilitar las pruebas de desarrollo
 * Solo debe ser usado con datos de prueba
 */

try {
    // 1. Contraseña en texto plano para práctica
    $nuevaClavePlana = 'Clave26';

    // 2. Generar el hash seguro de la contraseña
    $claveEncriptada = password_hash($nuevaClavePlana, PASSWORD_DEFAULT);

    // 3. Sentencia SQL UPDATE sin WHERE para afectar a todos los usuarios
    $sql = "UPDATE usuario SET contraseña = :nueva_clave";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nueva_clave' => $claveEncriptada]);

    // 4. Obtener la cantidad de registros actualizados
    $filasAfectadas = $stmt->rowCount();

    echo "Se actualizaron correctamente las contraseñas de {$filasAfectadas} usuarios.";
} catch (PDOException $e) {
    echo "Error al actualizar las contraseñas: " . $e->getMessage();
}
