# SUMMARY_EX1

## Resumen de la Solución

Esta solución implementa un servicio API y un comando de Artisan que retornan información de una aplicación (app) utilizando Laravel 11 y siguiendo una arquitectura hexagonal. Se utiliza un servicio en la capa de infraestructura para leer los datos desde archivos JSON, y un servicio de aplicación que orquesta la transformación de esos datos en el formato de salida requerido.

### Características:
- **Arquitectura Hexagonal**: Separación de dominio, aplicación, infraestructura y presentación.
- **Patrón de Inyección de Dependencias**: Permite sustituir fácilmente la fuente de datos (por ejemplo, se pueden reemplazar los archivos JSON por APIs externas).
- **Endpoint HTTP y Comando Artisan**: Ambos exponen la misma funcionalidad.
- **Tests**: Se proporcionan ejemplos de tests unitarios y de funcionalidad.

## Instrucciones de Instalación y Ejecución

1. **Clonar el repositorio:**
   ```bash
   git clone <URL-del-repositorio>
   cd gb-softonic-interview-api
