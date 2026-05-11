<p align="center">
  <img src="https://i.postimg.cc/4yKH00Nd/9f3469e4-2cf4-44e0-bf77-bc28b015f363.jpg" alt="StudyHub-App" width="200">
</p>

# StudyHub-App - Plataforma de Compra/Creación/Realización de Cursos y Panel Administrador

## 1. Introducción

Este repositorio contiene el código fuente de **StudyHub-App**, una aplicación web diseñada para la compra, creación y realización de cursos de diferentes temáticas, junto con un panel administrador completo para gestionar la plataforma. El proyecto se ha desarrollado siguiendo una arquitectura orientada a servicios dentro de Laravel, con un diseño moderno que incluye modo oscuro, editor de contenido enriquecido y generación de certificados en PDF.

## 2. Datos generales del Proyecto

### 2.1 Título del proyecto
StudyHub-App

### 2.2 Descripción del proyecto
StudyHub-App es una aplicación que permite a los usuarios comprar, crear y realizar cursos sobre diversas temáticas, además de proporcionar un panel administrador para gestionar la plataforma. Incluye un sistema completo de progreso de cursos, gestión de lecciones multimedia, facturación con historial de compras, certificados de finalización y un diseño adaptable con modo claro/oscuro.

### 2.3 Necesidades a cubrir
La plataforma permite a los usuarios buscar, comprar y realizar cursos en línea, ofreciendo flexibilidad y comodidad en el aprendizaje.

EJ: Una persona quiere realizar un curso online de NextJS, así que para ello accede a nuestra plataforma y compra un curso, pudiendo elegir entre todos los disponibles. La persona realiza el curso.
Acude a nuestra web debido a su sencillez y ser online (no es presencial, por lo que tiene total control de horas y evita la movilidad). 

### 2.4 Entorno Tecnológico del proyecto
- **Backend:** Laravel 10.x / PHP 8.2
- **Frontend:** Blade + Tailwind CSS 3.x + Alpine.js
- **Bundler:** Vite 4.x
- **Editor de contenido:** Editor.js (con plugins de código, imágenes, listas, citas, etc.)
- **Base de datos:** MySQL 8.0
- **Servidor web:** Apache 2.4
- **Generación de PDFs:** DomPDF (barryvdh/laravel-dompdf)
- **Gestión de medios:** Spatie Media Library
- **Roles y permisos:** Spatie Laravel Permission
- **Autenticación:** Laravel Breeze

### 2.5 Software
- Visual Studio Code
- Laragon
- Docker

## 3. Descripción del proyecto

StudyHub-App es una plataforma completa que incluye las siguientes características:

- **Autenticación completa**: Registro, inicio de sesión, recuperación de contraseña por email, verificación de correo electrónico y eliminación de cuenta (soft-delete y hard-delete).
- **Panel de usuario (Dashboard)**: Panel principal con resumen del último curso en progreso, porcentaje de avance, número de cursos finalizados y accesos directos a las diferentes secciones.
- **Perfil de usuario**: Gestión de información personal (nombre, email, contraseña) y perfil extendido con avatar, biografía y datos adicionales.
- **Compra de cursos**: Marketplace integrado para explorar, filtrar, buscar y comprar cursos por categoría. Vista detallada de cada curso con información completa y cursos relacionados.
- **Creación de cursos**: Los usuarios pueden crear sus propios cursos con un flujo guiado: información básica → creación de lecciones en dos pasos (metadatos + contenido). Los cursos nuevos quedan desactivados hasta ser validados por un administrador.
- **Reproductor de cursos**: Visualización de lecciones con soporte para múltiples tipos de contenido (vídeo, PDF, imágenes, texto, contenido enriquecido con Editor.js). Sistema de progreso automático con seguimiento de la lección actual.
- **Certificados de finalización**: Generación y descarga de certificados en PDF (formato A4 horizontal) al completar un curso.
- **Información de pago**: Gestión de tarjeta de crédito asociada a la cuenta y historial de compras con descarga de recibos en PDF.
- **Panel administrador**: Sección exclusiva con CRUD completo para usuarios, cursos, categorías, lecciones y roles. Incluye sistema de validación de cursos, búsquedas avanzadas y gestión de estados (activar/desactivar/eliminar).
- **Modo oscuro**: Soporte completo de tema claro/oscuro en la interfaz, con clases `dark:` de Tailwind CSS.
- **Páginas legales**: Condiciones de uso, política de privacidad y ayuda/asistencia.

### 3.1 Pantallas

- **Landing Page**: Página principal con información de la plataforma y enlaces de registro e inicio de sesión.
  
- **Auth**:
  - Registro: Formulario de registro con validación de nombre de usuario personalizada.
  - Inicio de sesión: Formulario de login con opción de recuperación de contraseña por email.
  - Verificación de email y restablecimiento de contraseña.
    
- **Dashboard**: Panel principal con widget del último curso en progreso, barra de porcentaje, cursos finalizados y accesos rápidos.
  
- **Perfil**: Información de la cuenta y perfil extendido. Opciones de actualización de datos, contraseña y eliminación de cuenta (soft-delete / hard-delete).
  
- **Mis cursos**: 
  - **Cursos creados**: Listado paginado con opciones de editar, activar/desactivar y enviar a validación. Gestión de lecciones (agregar, editar, eliminar). Los cursos editados requieren re-validación por un administrador.
  - **Cursos comprados**: Listado con estado de progreso. Posibilidad de empezar, continuar desde el último punto o reiniciar. Descarga de certificado al finalizar.
    - Las lecciones pueden ser de diferentes tipos: vídeo, PDF, texto, imágenes o contenido enriquecido (Editor.js).
    - Reproductor de lecciones integrado con navegación entre lecciones y seguimiento automático del progreso.
    - Descarga de recibo de compra en PDF.

- **Marketplace**: Exploración de cursos y categorías.
  - Últimos cursos y categorías destacadas.
  - Vista completa de todos los cursos y categorías con paginación.
  - Buscador integrado con filtros.
  - Vista detallada de cada curso con descripción, lecciones, precio y cursos relacionados.
  - Creación de nuevos cursos directamente desde el marketplace.
  - Compra de cursos (requiere tarjeta de crédito registrada).

- **Información de pago**: Agregar/editar tarjeta de crédito. Historial de compras con descarga de recibo en PDF.
  
- **Panel administrador**: 
  - Dashboard de administración con acceso a todas las secciones.
  - CRUD de categorías: crear, editar, activar/desactivar, eliminar permanentemente.
  - CRUD de cursos: crear, editar, validar/rechazar, activar/desactivar, eliminar. Vista detallada de cada curso.
  - CRUD de usuarios: crear, editar, activar/desactivar, eliminar.
  - CRUD de roles: crear, editar, activar/desactivar, eliminar. Gestión de permisos con Spatie.
  - CRUD de lecciones: crear (2 pasos), editar, eliminar.
  - Buscadores integrados en cada sección.

### 3.2 Arquitectura y patrones

La aplicación sigue una arquitectura MVC con **capa de servicios** para la lógica de negocio reutilizable:

- **Controllers**: Gestionan las peticiones HTTP y delegan la lógica a servicios.
- **Services**: `CourseProgressService` (cálculo de progreso y datos del dashboard) y `LessonService` (creación, actualización y eliminación de lecciones compartida entre controladores de usuario y administrador).
- **Form Requests**: Validación de datos separada en request classes dedicadas.
- **Custom Rules**: Regla personalizada `UsernameValidationRule` para validación de nombres de usuario.
- **Blade Components**: Componentes reutilizables para botones, modales, inputs, dropdowns, navegación, etc.
- **Layouts compartidos**: `app.blade.php` (autenticado) y `guest.blade.php` (invitado) con navegación responsive.
- **Soft Deletes**: Sistema de borrado lógico para cursos y usuarios, permitiendo restauración.
- **Spatie Media Library**: Gestión de archivos multimedia asociados a cursos y lecciones.
- **Spatie Laravel Permission**: Sistema de roles y permisos granular.

### 3.3 Modelos de datos

| Modelo | Descripción |
|---|---|
| `User` | Usuarios de la plataforma |
| `UserProfile` | Perfil extendido del usuario |
| `Course` | Cursos con soft-delete y validación |
| `CourseCategory` | Categorías de cursos |
| `Lesson` | Lecciones pertenecientes a cursos |
| `LessonType` | Tipos de lección (vídeo, PDF, texto, imagen, editor) |
| `User_course` | Relación usuario-curso (compras) |
| `User_course_progress` | Progreso del usuario en un curso |
| `User_course_status` | Estados del curso (no empezado, en progreso, finalizado) |
| `User_lesson` | Relación usuario-lección |
| `BillingInformation` | Información de tarjeta de crédito |
| `BillingHistory` | Historial de compras |
| `CreditCardType` | Tipos de tarjeta de crédito |
| `CustomRole` | Roles personalizados |

### 3.4 Consideraciones adicionales

Se utilizan layouts compartidos para mejorar la eficiencia y la consistencia del código y la interfaz de usuario.

Modelo seguido:

**![Modelo completo](https://github.com/manumengo71/StudyHub-App/blob/develop/DocumentacionAPP/Diagramas/modelocompleto.png)**

Puedes encontrar toda la documentación completa, junto a toda la información y lo necesario de la aplicación en **[Documentación APP](https://github.com/manumengo71/StudyHub-App/tree/develop/DocumentacionAPP)**.

## 4. Instalación y despliegue

### 4.1 Instalación y despliegue local:

1. Clona este repositorio: `git clone https://github.com/manumengo71/StudyHub-App`

2. Instala las dependencias PHP: `composer install`

3. Instala las dependencias de frontend: `npm install`

4. Copia el archivo `.env.example` y renómbralo a `.env`

5. Genera una nueva clave de aplicación: `php artisan key:generate`

6. Configura tu base de datos en el archivo `.env` (y todo lo necesario)

7. Ejecuta las migraciones de la base de datos: `php artisan migrate`

8. Ejecuta el Database seeder que contiene datos de prueba: `php artisan db:seed` (solo si se requieren). Si NO se requieren datos de prueba, ejecutar: `php artisan db:seed --class=DatabaseProductionSeeder` (Crea las tablas con los datos necesarios para el correcto funcionamiento de la aplicación).

9. Genera un acceso directo al almacenamiento público ejecutando: `php artisan storage:link`.

10. Compila los assets de frontend: `npm run dev` (desarrollo) o `npm run build` (producción).

11. Inicia el servidor: `php artisan serve` (en caso de no utilizar alguna aplicación como Laragon, XAMPP...).

12. Visita `http://localhost:8000` en tu navegador (o la ruta utilizada por tu aplicación).
    
<br/>

### 4.2 Instalación y despliegue con Docker (Dockerizar APP):

1. Clona este repositorio: `git clone https://github.com/manumengo71/StudyHub-App`

1. Ejecutar `docker-compose up --build -d` (Construye las imágenes e inicia los contenedores).
2. Lanzar `docker exec -it mi-contenedor-laravel /bin/bash` (Acceso interactivo al contenedor).
3. Dentro del contenedor, ejecutar la base de datos:
    - `php artisan migrate` (Crea las tablas).
    - `php artisan db:seed` (Puebla con datos de prueba).
    - O bien: `php artisan db:seed --class=DatabaseProductionSeeder` (Solo datos esenciales).

Los contenedores Docker incluyen:
- **Laravel + Apache**: Servidor web (Puerto 8000).
- **MySQL 8.0**: Base de datos.
- **phpMyAdmin**: Gestión de BD (Accesible en `http://localhost:8080`).
- **Mailpit**: Servidor de correo para pruebas (Accesible en `http://localhost:8025`).

<br/>
<br/>

<hr/>

### Credenciales inicio sesión:

* **Si la base de datos se ha migrado CON datos de prueba:** *
1. En la sección "Iniciar sesión", ingrese la siguiente información:
    - username -> admin
    - password -> 1234567890

* **Si la base de datos se ha migrado SIN datos de prueba:** *
2. En la sección "Crear cuenta", ingrese la siguiente información para establecer una cuenta de administrador con todos los permisos necesarios. Se creará tambien la cuenta global de la aplicación:
    - email -> hola.studyhubapp@gmail.com
    - username -> studyhub-app-admin
    - password -> adminstudyhub-app


La cuenta global de la aplicación es muy importante para el correcto desarrollo de la aplicación ya que es la que se hace cargo de los cursos de los usuarios que eliminen su cuenta, es decir, si un usuario que ha creado un curso y este ha sido comprado por otro usuario, en caso de que el usuario que creó el curso elimine su cuenta, el curso debe seguir siendo accesible para los usuarios que lo compraron, es por ello que los cursos creados por los usuarios eliminados pasarán a ser propiedad de la cuenta global.


<hr/>

### Versiones utilizadas

| Tecnología | Versión |
|---|---|
| Laravel | 10.x |
| PHP | 8.2.4 |
| MySQL | 8.0.30 |
| Apache | 2.4.54 |
| Node.js | 20.11.1 |
| Tailwind CSS | 3.x |
| Vite | 4.x |
| Alpine.js | 3.x |

<br/>

## Creador, redes e información:
¡Hola! Soy Manuel C. Mendoza González, actualmente estoy cursando el grado superior DAW (Desarrollo de Aplicaciones Web). Este repositorio incluye todo mi trabajo del proyecto. ¡Espero que os guste!
<br/><br/>
Hecho con cariño ❤️.

<a href="https://www.linkedin.com/in/manuelcandidomendozagonzalez" target="_blank">
    <img src="https://img.shields.io/badge/-LinkedIn-blue?style=for-the-badge&logo=linkedin&logoColor=white" alt="LinkedIn">
</a>

<a href="https://github.com/manumengo71" target="_blank">
    <img src="https://img.shields.io/badge/-GitHub-black?style=for-the-badge&logo=github&logoColor=white" alt="GitHub">
</a>
