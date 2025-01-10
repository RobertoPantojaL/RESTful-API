# Proyecto API RESTful con Interfaz de Usuario (UX)

Este proyecto es una API RESTful para la gestión de usuarios junto con una interfaz de usuario interactiva que permite realizar operaciones CRUD sobre la base de datos. Está construido con PHP para el backend, MySQL para la base de datos y HTML, CSS y JavaScript para el frontend.

## Requisitos

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Un servidor web (como Apache o Nginx)
- Acceso a la terminal para la instalación de dependencias (si es necesario)

## Estructura del Proyecto

1. **API RESTful**:  
   - **Archivo**: `api.php`  
   - Permite realizar las operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre los usuarios en la base de datos.

2. **Interfaz de Usuario (UX)**:  
   - Utiliza HTML, CSS (con Flexbox) y JavaScript para manejar las solicitudes a la API y actualizar dinámicamente la interfaz.

3. **Base de Datos**:  
   - MySQL para almacenar los usuarios y gestionar las operaciones CRUD.

## Instalación y Configuración

### 1. Clona el Repositorio

Para comenzar, clona este repositorio en tu máquina local.

### 2. Configuración de la Base de Datos

Asegúrate de tener una base de datos MySQL configurada. Puedes crear una base de datos con el siguiente comando.

#### Importa la Base de Datos General

En el archivo `database.sql` encontrarás la estructura básica de la base de datos para usuarios. Importa este archivo en tu servidor MySQL.

Si deseas proporcionar una base de datos personalizada para los usuarios, crea un archivo `.sql` con la estructura adecuada y compártelo con los usuarios para que lo puedan importar.

### 3. Configuración del Backend

#### Archivo de Configuración de la Base de Datos

Asegúrate de editar el archivo `config.php` para proporcionar las credenciales correctas para tu base de datos.

#### Verifica la API

La API está en el archivo `api.php`. Asegúrate de que tu servidor web pueda acceder a este archivo correctamente y que la base de datos esté configurada.

# Comando para clonar el repositorio
git clone https://github.com/usuario/proyecto-api-ux.git
cd proyecto-api-ux

-- Comando para crear la base de datos
CREATE DATABASE usuarios_db;

# Comando para importar la base de datos
mysql -u root -p usuarios_db < database.sql
// Archivo config.php
<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'usuarios_db');

function getDB() {
    $dbConnection = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConnection;
}
?>

## Uso de la API

### Endpoints

- **GET**: Obtener todos los usuarios o un usuario específico.
  - **Ruta**: `/api.php?id=1`
  - **Descripción**: Devuelve todos los usuarios o un usuario específico si se proporciona el `id`.

- **POST**: Crear un nuevo usuario.
  - **Ruta**: `/api.php`
  - **Descripción**: Crea un nuevo usuario en la base de datos. Requiere un cuerpo con `name` y `email`.

- **PUT**: Actualizar un usuario existente.
  - **Ruta**: `/api.php`
  - **Descripción**: Actualiza un usuario con los datos proporcionados en el cuerpo de la solicitud. Requiere `id`, `name`, y `email`.

- **DELETE**: Eliminar un usuario.
  - **Ruta**: `/api.php`
  - **Descripción**: Elimina un usuario de la base de datos utilizando el `id`.

  ## Interfaz de Usuario (UX)

### Funcionalidades

- **Ver todos los usuarios**: Visualiza todos los usuarios registrados en la base de datos.
- **Agregar un nuevo usuario**: Permite crear un nuevo usuario mediante un formulario.
- **Actualizar un usuario**: Permite actualizar la información de un usuario mediante un formulario.
- **Eliminar un usuario**: Permite eliminar un usuario de la base de datos.

### Requisitos de Frontend

- **HTML**: Utilizado para la estructura básica de la interfaz.
- **CSS**: Utiliza Flexbox para el diseño responsive.
- **JavaScript**: Para manejar las solicitudes a la API y actualizar dinámicamente la tabla de usuarios.

## Contribuciones

Si deseas contribuir a este proyecto, sigue estos pasos:

1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b nueva-funcionalidad`).
3. Realiza tus cambios y haz commit (`git commit -am 'Agrega nueva funcionalidad'`).
4. Sube los cambios a tu rama (`git push origin nueva-funcionalidad`).
5. Crea un pull request.

## Licencia

Este proyecto está bajo la Licencia MIT. Para más detalles, consulta el archivo [LICENSE](LICENSE).
