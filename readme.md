# En Bici - Ejemplo práctico

## Descripción del repositorio

**Baltasar Web** es un proyecto desarrollado con el framework "enbici", que adapta la lógica desarrollada durante tanto en tiempo a nivel base de datos y es incorporada a un esquema de trabajo moderno que permite la adaptación de los desarrolladores a las tecnologías modernas. 

```
|-- Baltasar 
    |-- archivos ==> carpeta de funcionalidad 
    |-- classes ==> carpeta de clases 
    |-- listados ==> carpeta de funcionalidad 
    |-- operaciones ==> carpeta de funcionalidad 
    |-- resources ==> carpeta de recursos propios de la aplicación 
    |-- views ==> carpeta de vistas de la aplicación 
    |-- application.php ==> archivo principal de la aplicación 
    |-- autoload.php ==> definición de paths de clases 
    |-- db.inc.php ==> parámetros de configuración de base de datos 
    |-- master.php ==> template de vista 
    |-- ws.request.php ==> métodos de invocación vía ajax
|-- OPDS.DB ==> carpeta del framework
|-- OPDS.Render ==> carpeta del framework
|-- OPDS.Style ==> carpeta del framework
```

### 1. Archivos principales

**Lista de archivos:**

- `application.php`: 
  - Definición de variables globales.
  - Include de funcionalidad general.
  - Manejo de sesión.

- `autoload.php`:
  - Define los paths donde hay clases. Cada clase será incluida automáticamente y estará disponible sin necesidad de un include manual.

- `db.inc.php`:
  - Contiene los parámetros de la cadena de conexión. **¡Importante!** No sobrescribir este archivo al pasar de desarrollo a producción para no perder la configuración de test/producción.

- `master.php`:
  - Define el esqueleto HTML de la aplicación, con los links a CSS, JavaScript, menú y otros elementos comunes a todas las vistas.

- `ws.request.php`:
  - Centraliza los mensajes que la aplicación interpreta y devuelve como resultados en formato JSON para invocaciones vía Ajax.

### 2. Clases

Las clases contienen la lógica y la invocación de los stored procedures que realizan operaciones en Baltasar, como liquidar valores o obtener listas de operatorias. Cada archivo en la carpeta `classes` debe contener una sola clase con el mismo nombre que el archivo. Estas clases son cargadas automáticamente gracias al `autoload.php`.

### 3. Vistas

La carpeta `views` contiene archivos `.php` con el HTML estático de cada página o vista, que deben seguir la nomenclatura `funcionalidad.view.php`.

### 4. Ejemplo funcional: Liquidación de valores

- **Ruta:** Operaciones > Liquidar Valores.
- **Proceso:** 
  - Al hacer clic en Liquidar Valores, se accede a `/operaciones/liquidarValores.php`.
  - El archivo carga la configuración (application.php), calcula los datos necesarios y luego compone la vista con `master.php` + `liquidarValores.view.php` + `liquidarValores.js`.

### 5. Desarrollo de una nueva funcionalidad

Para desarrollar una nueva pantalla, como "Liquidar Matafuegos", se requieren los siguientes archivos:

- Vista: `/views/liquidarMatafuegos.view.php`.
- Lógica de eventos: `/resources/js/liquidarMatafuegos.js`.
- Recursos: dentro de `/resources/*`.
- Archivo funcional: `/operaciones/liquidarMatafuegos.php`.
- Clases: Ej. `/classes/matafuegos.php`.
- Stored procedures necesarios.

### Funcionalidad OPDS

- Carpetas con prefijo "OPDS." corresponden a funcionalidad genérica.

#### A1. Anexo OPDS.DB

- Código de métodos que interactúan con la base de datos.

#### A2. Anexo OPDS.Render

- Componentes y funciones generales de JavaScript.

#### A3. Anexo OPDS.Security

- Lógica y configuración para acceder a la base de seguridad.

#### A4. Anexo OPDS.Style

- Imágenes y CSS generales.

### Pendientes del proyecto:

- **Captura y logueo de errores:** Se debe implementar un sistema robusto de captura y registro de errores para garantizar la trazabilidad y facilitar el mantenimiento de la aplicación.
  
- **Administración de librerías JS con npm:** Se requiere incorporar npm para la gestión de librerías JavaScript, lo que permitirá una mejor organización y actualización de las dependencias.

- **Administración de componentes PHP con Composer:** Es necesario integrar Composer para manejar las dependencias PHP del proyecto, lo que optimizará el flujo de desarrollo y mantenimiento de los componentes.
