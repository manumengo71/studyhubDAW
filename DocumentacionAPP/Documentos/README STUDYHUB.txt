<p align="center">
  <img src="https://i.postimg.cc/4yKH00Nd/9f3469e4-2cf4-44e0-bf77-bc28b015f363.jpg" alt="StudyHub-App" width="200">
</p>

# StudyHub - Plataforma de Compra/Creación/Realización de Cursos y Panel Administrador

## 1. Introducción

Este repositorio contiene el código fuente de StudyHub, una aplicación web diseñada para la compra de cursos de diferentes temáticas, junto con un panel administrador completo para gestionar la plataforma.

## 2. Datos generales del Proyecto

### 2.1 Título del proyecto
StudyHub-App

### 2.2 Descripción del proyecto
StudyHub es una aplicación que permite a los usuarios comprar, crear y realizar cursos sobre diversas temáticas, además de proporcionar un panel administrador para gestionar la plataforma.

### 2.3 Necesidades a cubrir
La plataforma permite a los usuarios buscar, comprar y realizar cursos en línea, ofreciendo flexibilidad y comodidad en el aprendizaje.

EJ: Una persona quiere realizar un curso online de NextJS, así que para ello accede a nuestra plataforma y compra un curso, pudiendo elegir entre todos los disponibles. La persona realiza el curso.
Acude a nuestra web debido a su sencillez y ser online (no es presencial, por lo que tiene total control de horas y evita la movilidad). 

### 2.3 Entorno Tecnológico del proyecto
- Laravel
- Blade
- Tailwind CSS
- MySQL
- Apache
- PHP
- npm

### 2.4 Software
- Visual Studio Code
- Laragon
- Docker

## 3. Descripción del proyecto

StudyHub es una plataforma completa que incluye las siguientes características:

- **Autenticación**: Los usuarios pueden registrarse e iniciar sesión en la plataforma, junto con todo lo relacionado con ello y lo que implica (Recuperar contraseña, eliminar cuenta...).
- **Panel de usuario**: Cada usuario tiene un perfil personal donde pueden ver y actualizar su información, así como administrar su cuenta. También tienen una sección donde podrán administrar y realizar los cursos creados y comprados.
- **Compra de cursos**: Los usuarios pueden explorar, comprar y realizar cursos de diferentes temáticas desde el marketplace integrado.
- **Creación de cursos**: Los usuarios también tienen la posibilidad de crear sus propios cursos y administrarlos.
- **Panel administrador**: Los administradores tienen acceso a un panel especial con funciones de administración completa, incluyendo CRUD para los diferentes modelos de datos.

### 3.1 Pantallas

- **Landpage**: Página principal con información básica y enlaces de registro e inicio de sesión.
  
- **Auth**:
  - Registro: Formulario de registro. Botón para ir al login.
  - Inicio de sesión: Formulario de inicio de sesión. Botón de has olvidado contraseña para recuperarla a través de un correo electrónico.
    
- **Dashboard**: Panel principal con enlaces rápidos a las diferentes secciones de la plataforma.
  
- **Perfil**: Información del usuario y opciones de gestión de la cuenta.
  
- **Mis cursos**: Lista de cursos comprados y creados por el usuario.
  - Cursos creados: Se podrán editar y desactivar/activar a través de un formulario de actualización. Se podrán agregar o eliminar lecciones. Los cursos nuevos/editados tendrán que ser validados por un administrador para su publicación.
  - Cursos comprados: Se podrán empezar o seguir desde el último punto. Se visualizará el contenido de él.
        - Las lecciones de cada curso podrán ser de diferentes tipos (pdf, texto, video, imágenes…). Se visualizará en un reproductor de lecciones.
        - Se podrá descargar en forma de PDF el recibo de la compra de los cursos comprados(en otra vista).

- **Marketplace**: Página para explorar y comprar cursos.
  - En la página se podrán ver categorías y cursos, aparecerán los ultimos cursos y categorías, asi como lo mas relevantes y la posibilidad de tener una lista completa (página que los contiene a todos) de todos juntos.
  - Desde esta página se podran crear nuevos cursos (por defecto irán desactivados hasta no completar un mínimo de información de él).
  - Se podrá ir a la vista detallada del curso en la que aparecerá toda su información y cursos relacionados.
  - Una vez comprado un curso se agregará a la lista en mis cursos.
  - Se podrá filrar y buscar los cursos y categorías a través de su buscador integrado.
    
- **Información de pago**: Agregar/editar la tarjeta de crédito asociada a la cuenta. Historial de compras, donde se podrá ver un general de cada curso y podrá descargarase un pdf con el recibo de compra.
  
- **Panel administrador**: Sección exclusiva para administradores con funciones de gestión. Se tiene acceso completo a todos los datos y modelos de la aplicación y la total gestión de ellos. Métodos de validación de cursos para seguridad.

### 3.2 Tecnologías utilizadas

La plataforma utiliza Laravel como framework backend, Blade, JS , Tailwind CSS para el diseño, y MySQL como base de datos.

### 3.3 Consideraciones adicionales

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

10. Inicia el servidor: `php artisan serve` (en caso de no utilizar alguna aplicación como laragon, xampp...)

11. Visita `http://localhost:8000` en tu navegador (o la ruta utilizada por tu aplicación).
    
<br/>

### 4.2 Instalación y despliegue con Docker (Dockerizar APP):

1. Clona este repositorio: `git clone https://github.com/manumengo71/StudyHub-App`

2. Ejecutar `docker-compose up --build -d` (construye las imágenes de Docker según el archivo dockerfile, inicia los contenedores en segundo plano y los deja corriendo).

3. Lanzar `docker exec -it mi-contenedor-laravel /bin/bash` (Abre terminal para utilizar comandos).
    - 3.2. Lanzar `php artisan migrate` para ejecutar las migraciones (Crear base de datos).
    - 3.3. (SI SE REQUIEREN DATOS DE PRUEBA) -> Lanzar `php artisan db:seed`
    - 4.4. (SI NO SE REQUIEREN DATOS DE PRUEBA) -> Lanzar `php artisan db:seed --class=DatabaseProductionSeeder`

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
    - email -> hola.studyhubapp.com
    - username -> studyhub-app-admin
    - password -> adminstudyhub-app

<hr/>

** **Versión de laravel utilizada: 10.x | Versión de PHP utilizada: 8.2.4 | Versión de MYSQL utilizada: 8.0.30 | Versión de apache utilizada: 2.4.54 | Versión de Node.js utilizada: 20.11.1** **

<br/>

## Creador, redes e información:
¡Hola! Soy Manuel Cándido Mendoza González, actualmente estoy cursando el grado superior DAM (Desarrollo de aplicaciones multiplataforma) en modalidad dual y estoy realizando mi FCT y TFG. Este repositorio incluye todo mi trabajo para el proyecto del TFG. ¡Espero que os guste!
<br/><br/>
Hecho con cariño ❤️.

<a href="https://www.linkedin.com/in/manuelcandidomendozagonzalez" target="_blank">
    <img src="https://img.shields.io/badge/-LinkedIn-blue?style=for-the-badge&logo=linkedin&logoColor=white" alt="LinkedIn">
</a>

<a href="https://github.com/manumengo71" target="_blank">
    <img src="https://img.shields.io/badge/-GitHub-black?style=for-the-badge&logo=github&logoColor=white" alt="GitHub">
</a>
