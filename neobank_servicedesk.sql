/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.7.2-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: neobank_servicedesk
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(10) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `cedula` (`cedula`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES
(1,'1712345678','Juan Pablo','González Pérez','juan.gonzalez@email.com','0991234567','Av. 10 de Agosto y Colón, Quito','2026-08-06 19:01:38',1),
(2,'0923456789','María Elena','Rodríguez Vera','maria.rodriguez@email.com','0982345678','Cdla. Kennedy Norte Mz 12, Guayaquil','2026-08-06 19:01:38',2),
(3,'1103456780','Carlos Alberto','Benítez Mendoza','carlos.benitez@email.com','0973456789','Calle Larga 4-12, Cuenca','2026-08-06 19:01:38',3),
(4,'1314567891','Lucía Isabel','Morales Intriago','lucia.morales@email.com','0964567890','Av. Malecón y Calle 13, Manta','2026-08-06 19:01:38',4),
(5,'0805678902','Andrea Sofia','Soto Castro','andrea.soto@email.com','0955678901','Calle Bolívar 8-20, Esmeraldas','2026-08-06 19:01:38',5),
(6,'1799999999','Prueba','Seguridad','prueba.sec@neobank.ec','0990000000','Quito','2026-08-08 23:31:53',9);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_empleado` varchar(20) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_empleado`),
  UNIQUE KEY `codigo_empleado` (`codigo_empleado`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES
(1,'EMP-2026-001','Carlos Javier','Mendoza Solís','carlos.mendoza@neobank.com','Especialista de Soporte L1','2026-08-06 19:02:10',6),
(2,'EMP-2026-002','Ana Belén','Torres Rivas','ana.torres@neobank.com','Especialista de Soporte L2','2026-08-06 19:02:10',7),
(3,'EMP-2026-003','Roberto Daniel','Vargas Silva','roberto.vargas@neobank.com','Supervisor Service Desk','2026-08-06 19:02:10',8);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_incidente`
--

DROP TABLE IF EXISTS `estado_incidente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado_incidente` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_estado`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_incidente`
--

LOCK TABLES `estado_incidente` WRITE;
/*!40000 ALTER TABLE `estado_incidente` DISABLE KEYS */;
INSERT INTO `estado_incidente` VALUES
(1,'Registrado','Ticket creado por el cliente'),
(2,'En Proceso','Ticket asignado y en atencion por soporte'),
(3,'Resuelto','Incidente solucionado tecnicamente'),
(4,'Cerrado','Atencion finalizada y confirmada');
/*!40000 ALTER TABLE `estado_incidente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incidente`
--

DROP TABLE IF EXISTS `incidente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `incidente` (
  `id_incidente` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_incidente` varchar(20) NOT NULL,
  `asunto` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_tipo_solicitud` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_incidente`),
  UNIQUE KEY `codigo_incidente` (`codigo_incidente`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_tipo_solicitud` (`id_tipo_solicitud`),
  KEY `id_estado` (`id_estado`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `incidente_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON UPDATE CASCADE,
  CONSTRAINT `incidente_ibfk_2` FOREIGN KEY (`id_tipo_solicitud`) REFERENCES `tipo_solicitud` (`id_tipo_solicitud`) ON UPDATE CASCADE,
  CONSTRAINT `incidente_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estado_incidente` (`id_estado`) ON UPDATE CASCADE,
  CONSTRAINT `incidente_ibfk_4` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incidente`
--

LOCK TABLES `incidente` WRITE;
/*!40000 ALTER TABLE `incidente` DISABLE KEYS */;
INSERT INTO `incidente` VALUES
(1,'INC-2026-0001','Error en transferencia bancaria','Al intentar realizar una transferencia directo a otro banco me arroja el codigo ERR-502.','2026-08-01 09:15:00','2026-08-01 11:30:00',1,1,4,1),
(2,'INC-2026-0002','Cobro duplicado en tarjeta de débito','Se me débito dos veces la compra en el supermercado por un valor de $45.20.','2026-08-03 14:20:00',NULL,2,3,2,2),
(3,'INC-2026-0003','Consulta sobre tasa de interés en depósito','Requiero información detallada sobre el rendimiento anual del depósito a plazo fijo.','2026-08-04 10:00:00','2026-08-04 10:45:00',3,2,3,1),
(4,'INC-2026-0004','App se cierra inesperadamente al escanear QR','Al presionar la opción de pago por QR en la App móvil (Android v14), se fuerza el cierre.','2026-08-05 18:05:00',NULL,4,1,1,NULL),
(5,'INC-2026-0005','Sugerencia para autenticación biométrica','Sería genial que agreguen soporte para FaceID en el inicio de sesión.','2026-08-06 08:30:00',NULL,5,4,2,1),
(6,'INC-2026-0006','Bloqueo imprevisto de tarjeta de crédito','El cliente reporta que su tarjeta fue bloqueada al intentar realizar un pago en punto de venta.','2026-08-07 08:30:00','2026-08-07 10:15:00',1,1,4,1),
(7,'INC-2026-0007','Falla en autenticación OTP por SMS','No están llegando los códigos de seguridad SMS para autorizar transferencias interbancarias.','2026-08-07 09:45:00',NULL,2,1,2,1),
(8,'INC-2026-0008','Error al generar certificado bancario','La plataforma genera un archivo PDF corrupto al descargar el certificado de cuenta corriente.','2026-08-07 11:20:00','2026-08-07 12:00:00',3,1,3,1),
(9,'INC-2026-0009','Límite diario de retiro no actualizado','Se aprobó el incremento del límite de retiro en cajero pero el sistema sigue aplicando el límite anterior.','2026-08-07 14:10:00',NULL,4,1,2,1),
(10,'INC-2026-0010','Interrupción de servicio en módulo de inversiones','Al intentar ingresar a la pestaña de pólizas de inversión la app muestra una pantalla en blanco.','2026-08-07 16:50:00',NULL,5,1,1,1),
(11,'INC-ADE43','App demora en cargar','App móvil se queda en la pagina de inicio.','2026-08-08 15:36:28',NULL,1,2,1,NULL);
/*!40000 ALTER TABLE `incidente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_solicitud`
--

DROP TABLE IF EXISTS `tipo_solicitud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_solicitud` (
  `id_tipo_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_solicitud`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_solicitud`
--

LOCK TABLES `tipo_solicitud` WRITE;
/*!40000 ALTER TABLE `tipo_solicitud` DISABLE KEYS */;
INSERT INTO `tipo_solicitud` VALUES
(1,'Incidente','Falla o interrupcion no planificada del servicio'),
(2,'Consulta','Solicitud de informacion o asistencia'),
(3,'Reclamo','Manifestacion de disconformidad con el servicio'),
(4,'Sugerencia','Propuesta de mejora por parte del cliente');
/*!40000 ALTER TABLE `tipo_solicitud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `nombre_usuario` (`nombre_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES
(1,'jgonzalez','$2y$10$S5M5X.sQlsvxH97IE0m7R.uv98BJHLHt/b3BLwpV50mjN.eQZ0g2.','CLIENTE','2026-08-06 19:00:33'),
(2,'mrodriguez','$2y$10$S5M5X.sQlsvxH97IE0m7R.uv98BJHLHt/b3BLwpV50mjN.eQZ0g2.','CLIENTE','2026-08-06 19:00:33'),
(3,'cbenitez','$2y$10$S5M5X.sQlsvxH97IE0m7R.uv98BJHLHt/b3BLwpV50mjN.eQZ0g2.','CLIENTE','2026-08-06 19:00:33'),
(4,'lmorales','$2y$10$S5M5X.sQlsvxH97IE0m7R.uv98BJHLHt/b3BLwpV50mjN.eQZ0g2.','CLIENTE','2026-08-06 19:00:33'),
(5,'andrea_soto','$2y$10$S5M5X.sQlsvxH97IE0m7R.uv98BJHLHt/b3BLwpV50mjN.eQZ0g2.','CLIENTE','2026-08-06 19:00:33'),
(6,'soporte_carlos','$2y$10$S5M5X.sQlsvxH97IE0m7R.uv98BJHLHt/b3BLwpV50mjN.eQZ0g2.','AGENTE_SOPORTE','2026-08-06 19:00:33'),
(7,'soporte_ana','$2y$10$S5M5X.sQlsvxH97IE0m7R.uv98BJHLHt/b3BLwpV50mjN.eQZ0g2.','AGENTE_SOPORTE','2026-08-06 19:00:33'),
(8,'admin_roberto','$2y$10$S5M5X.sQlsvxH97IE0m7R.uv98BJHLHt/b3BLwpV50mjN.eQZ0g2.','SUPERVISOR','2026-08-06 19:00:33'),
(9,'cliente.prueba.sec','$2y$10$hashdeprueba...','Cliente','2026-08-08 04:42:47');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'neobank_servicedesk'
--
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ClientesAtendidosPorEmpleadoFecha` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ClientesAtendidosPorEmpleadoFecha`(
    IN p_codigoEmpleado VARCHAR(20),
    IN p_fechaAtencion DATE
)
BEGIN
    SELECT 
        i.codigo_incidente,
        c.cedula,
        CONCAT(c.nombres, ' ', c.apellidos) AS nombre_cliente,
        c.email AS email_cliente,
        c.telefono,
        ts.nombre AS tipo_solicitud,
        ei.nombre AS estado,
        i.asunto,
        i.fecha_creacion
    FROM incidente i
    INNER JOIN cliente c ON i.id_cliente = c.id_cliente
    INNER JOIN empleado e ON i.id_empleado = e.id_empleado
    INNER JOIN tipo_solicitud ts ON i.id_tipo_solicitud = ts.id_tipo_solicitud
    INNER JOIN estado_incidente ei ON i.id_estado = ei.id_estado
    WHERE e.codigo_empleado = p_codigoEmpleado
      AND DATE(i.fecha_creacion) = p_fechaAtencion
    ORDER BY i.fecha_creacion DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ListarClientesPorTipoSolicitud` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ListarClientesPorTipoSolicitud`(
    IN p_nombreTipoSolicitud VARCHAR(50)
)
BEGIN
    SELECT DISTINCT
        c.cedula,
        CONCAT(c.nombres, ' ', c.apellidos) AS nombre_cliente,
        c.email,
        c.telefono,
        ts.nombre AS tipo_solicitud,
        i.codigo_incidente,
        i.asunto,
        i.fecha_creacion
    FROM incidente i
    INNER JOIN cliente c ON i.id_cliente = c.id_cliente
    INNER JOIN tipo_solicitud ts ON i.id_tipo_solicitud = ts.id_tipo_solicitud
    WHERE ts.nombre = p_nombreTipoSolicitud
    ORDER BY c.apellidos ASC, i.fecha_creacion DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-08-10  1:19:46
