# Guía de Comandos para la Defensa (Docker)

## 1. Levantar la infraestructura
Desde la raíz del proyecto, ejecuta el comando para construir y levantar los contenedores en segundo plano:
```powershell
docker-compose up --build -d
```
*Nota: Docker se encargará automáticamente de configurar el entorno, compilar los estilos y esperar a que la base de datos esté lista.*

## 2. Acceder al contenedor de Laravel
Una vez que los contenedores estén corriendo, entra de manera interactiva al contenedor de la aplicación:
```powershell
docker exec -it mi-contenedor-laravel /bin/bash
```

## 3. Preparar la Base de Datos (Demostración)
Dentro del contenedor (verás que el prompt cambia a `root@...`), ejecuta los comandos de Artisan:

### A. Crear las tablas
```bash
php artisan migrate
```

### B. Poblar con datos (Elegir una opción)
**Opción con datos de prueba (Recomendada para enseñar la web llena):**
```bash
php artisan db:seed
```

**Opción "Limpia" (Solo lo mínimo para funcionar):**
```bash
php artisan db:seed --class=DatabaseProductionSeeder
```

## 4. Acceso a la aplicación
Una vez terminados los comandos, puedes abrir el navegador en:
- **Web**: [http://localhost:8000](http://localhost:8000)
- **Base de datos (phpMyAdmin)**: [http://localhost:8080](http://localhost:8080)
- **Correos (Mailpit)**: [http://localhost:8025](http://localhost:8025) (Si está configurado)

---
