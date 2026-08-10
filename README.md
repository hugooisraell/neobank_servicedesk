# NEOBANK - Service Desk 

> **Practica:** Examen Complexivo
> **Estudiante:** Hugo Israel Lainez Medina  
> **Carrera:** Ingeniería en Ciencias de la Computación  
> **Fecha de Entrega:** Agosto, 2026  

---

**NEOBANK Service Desk** es un sistema web de gestión de incidencias y solicitudes desarrollado para un caso de estudio universitario. La plataforma centraliza el soporte técnico entre clientes, agentes de atención y supervisores mediante una arquitectura MVC.

---

##  Propósito del Proyecto
Demostrar la implementación de un sistema modular de mesas de ayuda (*Service Desk*) en un entorno bancario, aplicando control de acceso basado en roles, gestión de tickets y generación de reportes operativos.

---

##  Roles e Interfaces

* **Cliente:**
  * Visualización del panel personal con métricas de sus solicitudes.
  * Navegación interactiva (*drill-down*) desde las tarjetas del panel hacia el detalle filtrado de sus incidentes.
  * Registro de nuevas incidencias, consultas, reclamos o sugerencias.
* **Agente de Soporte:**
  * Dashboard interactivo con métricas de incidentes asignados por estado y tipo de solicitud.
  * Vista detallada de sus tickets al hacer clic en las tarjetas del panel.
  * Gestión y actualización de los estados de atención.
* **Supervisor:**
  * Métricas globales del sistema (total de tickets, incidentes sin asignar, estados y tipos).
  * Exploración de listados completos de incidentes mediante interacción directa con las métricas del dashboard.
  * Módulo para la generación de reportes de atención filtrados por agente y fecha.

---

##  Tecnologías Utilizadas
* **Lenguaje:** PHP (Arquitectura MVC + POO)
* **Base de Datos:** MariaDB / MySQL
* **Frontend:** HTML5, CSS3 (Diseño responsivo sin librerías externas)
* **Entorno:** Linux / XAMPP