# NEOBANK - Service Desk 

**NEOBANK Service Desk** es un sistema web de gestión de incidencias y solicitudes desarrollado para un caso de estudio universitario. La plataforma centraliza el soporte técnico entre clientes, agentes de atención y supervisores mediante una arquitectura MVC.

---

##  Propósito del Proyecto
Demostrar la implementación de un sistema modular de mesas de ayuda (*Service Desk*) en un entorno bancario, aplicando control de acceso basado en roles, gestión de tickets y generación de reportes operativos.

---

##  Roles e Interfaces

* **Cliente:**
  * Visualización del panel personal con métricas de solicitudes.
  * Registro de nuevas incidencias, consultas, reclamos o sugerencias.
* **Agente de Soporte:**
  * Dashboard de incidentes asignados categorizados por estado y tipo de solicitud.
  * Gestión y actualización de los estados de atención.
* **Supervisor:**
  * Métricas globales del sistema (total de tickets, incidentes sin asignar, etc.).
  * Módulo para la generación de reportes de atención filtrados por agente y fecha.

---

##  Tecnologías Utilizadas
* **Lenguaje:** PHP (Arquitectura MVC + POO)
* **Base de Datos:** MariaDB / MySQL
* **Frontend:** HTML5, CSS3 (Diseño responsivo sin librerías externas)
* **Entorno:** Linux / XAMPP