<?php
// modelos/Usuario.php

class Usuario
{
    private $db;

    // Constructor que recibe la instancia de conexión PDO
    public function __construct(PDO $conexion)
    {
        $this->db = $conexion;
    }

    /**
     * Valida las credenciales de usuario.
     * Soporta contraseñas con hash (password_verify) o texto plano.
     */
    public function validarCredenciales($nombre_usuario, $contrasena)
    {
        $sql = "SELECT id_usuario, nombre_usuario, contraseña, role 
                FROM usuario 
                WHERE nombre_usuario = :nombre_usuario 
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':nombre_usuario' => $nombre_usuario]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            // Verifica si la contraseña coincide (vía hash o directo)
            if (password_verify($contrasena, $usuario['contraseña']) || $contrasena === $usuario['contraseña']) {
                // Removemos la contraseña por seguridad antes de retornar
                unset($usuario['contraseña']);
                return $usuario;
            }
        }

        return false;
    }

    /**
     * Obtiene el rol formateado de un usuario mediante su id_usuario.
     */
    public function obtenerRolPorId($id_usuario)
    {
        $sql = "SELECT role FROM usuario WHERE id_usuario = :id_usuario LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_usuario' => $id_usuario]);
        $resultado = $stmt->fetch();

        return $resultado ? $resultado['role'] : null;
    }

    /**
     * Obtiene los datos detallados según el rol (si es empleado o cliente).
     */
    public function obtenerDetallePorRol($id_usuario, $tipo_perfil)
    {
        if ($tipo_perfil === 'empleado') {
            $sql = "SELECT * FROM empleado WHERE id_usuario = :id_usuario LIMIT 1";
        } elseif ($tipo_perfil === 'cliente') {
            $sql = "SELECT * FROM cliente WHERE id_usuario = :id_usuario LIMIT 1";
        } else {
            return null;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_usuario' => $id_usuario]);
        return $stmt->fetch();
    }
}
