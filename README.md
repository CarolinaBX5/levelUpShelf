# 🎮 Proyecto LevelUP Shelf

Este proyecto es una plataforma web para la gestión y visualización de una biblioteca de videojuegos, similar a Steam, desarrollada en **PHP** y utilizando una base de datos **PostgreSQL**.

## 🧱 Estructura del Proyecto

- 🏠 **index.php**: Página principal de la aplicación.  
- 🛠️ **admin.php, home.php, steam.php**: Módulos principales para administración, página de inicio y funcionalidades tipo Steam.  
- 🔐 **login.php, logout.php, cuentaUsuario.php**: Gestión de autenticación y cuentas de usuario.  
- 🗂️ **crearLibreria.php, libreria.php, userLibrary.php**: Funcionalidades para crear y gestionar bibliotecas de juegos de usuario.  
- 🎯 **detalles-juegos.php, games.php, gamesCategory.php, catalogo.php**: Visualización de detalles, categorías y catálogo de juegos.  
- 🚫 **404.php**: Página de error personalizada.  
- 🧭 **navBar.php**: Barra de navegación común.  
- 🔌 **conexion.php**: Configuración de conexión a la base de datos.

### 📁 Carpetas principales

- **handlers/**: Contiene scripts PHP para procesar formularios y acciones (registro, login, añadir juegos, crear bibliotecas, actualizar usuario, reseñas).  
- **bd/**: Configuración de la base de datos y scripts de inicialización.  
  - 🐳 `docker-compose.yml`: Para levantar la base de datos con Docker.  
  - 📂 `initdb.d/`: Scripts SQL para crear tablas, insertar datos y configurar la base.  
- **public/**: Archivos estáticos.  
  - 🎨 **css/**: Hojas de estilo para las diferentes secciones de la web.  
  - ⚙️ **js/**: Scripts JavaScript para paginación, búsqueda y efectos visuales.

## ⚙️ Instalación

1. 📥 **Clona el repositorio** en tu servidor local.  
2. 🗄️ **Configura la base de datos**:  
   - Usa Docker y el archivo `bd/docker-compose.yml` para levantar PostgreSQL.  
   - Los scripts en `bd/initdb.d/` crearán las tablas y datos iniciales.  
3. 🔌 **Configura la conexión** en `conexion.php` según tus credenciales de base de datos.  
4. 🌐 **Accede a la aplicación** desde tu navegador apuntando a `index.php`.

## 📦 Dependencias

- 🐘 PHP 8.2  
- 🐘 PostgreSQL  
- 🐳 Docker (opcional, recomendado para la base de datos)  
- 🌐 Navegador web moderno

## 📝 Notas

- 🎨 Personaliza los estilos en `public/css/` y los scripts en `public/js/` según tus necesidades.

## 📄 Licencia

Este proyecto es de uso académico/demostrativo. Modifícalo y distribúyelo según tus necesidades.
