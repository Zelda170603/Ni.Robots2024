#  Ni.Robots 🤖

**Ni.Robots** es una aplicación web inclusiva dirigida a **personas con discapacidades motoras**.  
El sistema está dividido en **tres módulos principales**: **Medicina**, **Educación** y **Ventas**, cada uno diseñado para promover la accesibilidad, la independencia y la integración con servicios externos.

---

## Descripción general

Ni.Robots ofrece un entorno digital donde los usuarios pueden acceder a servicios médicos, educativos y comerciales desde una sola plataforma.

-  **Medicina:** permite gestionar citas médicas presenciales y virtuales, historiales clínicos, reportes y la interacción entre médicos y pacientes.  
-  **Educación:** contiene artículos, libros y materiales informativos gestionados por el administrador, que sirven como recursos gratuitos para fomentar el aprendizaje.  
-  **Ventas:** funciona como un **e-commerce** completamente operativo, integrado con la API de **PayPal** para procesar pagos en línea.

El sistema también cuenta con un módulo de **Administración**, no visible para el público, donde se gestionan usuarios, médicos, productos, citas y publicaciones dentro del sistema.

---



## ⚙️ Tecnologías utilizadas

|                                                                                                                    Logo                                                                                                                   | Tecnología                  | Función principal                   |
| :---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------: | --------------------------- | ----------------------------------- |
|    <img alt="Laravel" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" height="32" /> <img alt="PHP" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" height="32" />    | **Laravel 10 (PHP)**        | Backend principal del sistema       |
|            <img alt="Blade" src="https://cdn.simpleicons.org/laravel/FF2D20" height="28" /> <img alt="TailwindCSS" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg" height="32" />           | **Blade + Tailwind CSS**    | Frontend y vistas dinámicas         |
| <img alt="MySQL" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" height="32" /> <img alt="MariaDB" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mariadb/mariadb-original.svg" height="32" /> | **MySQL / MariaDB**         | Base de datos relacional            |
|                   <img alt="Docker" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg" height="32" />                   | **Docker + Docker Compose** | Entorno de ejecución y orquestación |
|                                                             <img alt="Nginx" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nginx/nginx-original.svg" height="32" />                                                             | **Nginx**                   | Servidor web / proxy                |
|    <img alt="Node.js" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg" height="32" /> <img alt="Vite" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vite/vite-original.svg" height="32" />   | **Node.js + Vite**          | Compilación/empacado de JS/CSS      |


---

## Microservicios y APIs externas

Ni.Robots utiliza varios servicios externos que complementan su funcionamiento:

| Servicio externo | Función dentro del sistema |
|------------------|-----------------------------|
| **PayPal API** | Procesamiento de pagos en el módulo de ventas |
| **Google Maps API** | Geolocalización de centros médicos |
| **Agora.io** | Videollamadas entre médicos y pacientes |
| **OpenAI API** | Chatbot inteligente entrenado con información del sitio, disponible para orientar a los nuevos usuarios |

---

## 👥 Roles principales

| Rol | Funciones destacadas |
|------|------------------------|
| **Administrador** | Gestiona usuarios, médicos, productos, reportes y contenidos educativos |
| **Médico** | Accede a citas, reportes, expedientes médicos y videollamadas con pacientes |
| **Fabricante (Vendedor)** | Administra productos, inventario, ventas y reportes |
| **Paciente / Usuario** | Puede agendar citas, realizar compras, chatear con el asistente y acceder a material educativo |

---

## Despliegue con Docker

### 🔧 Requisitos previos

- Tener instalado **Docker** y **Docker Compose**.
- Configurar correctamente los archivos `.env`:
  - Uno para **Laravel** (en `Ni.Robots/.env`).
  - Otro para el **entorno Docker** (en la raíz del proyecto).

Esto permite usar una base de datos local o un servidor independiente, según la configuración.

---

###  Pasos para ejecutar el proyecto

1. **Construir la imagen de Docker**
   ```
   docker compose build
   ```
2. Levantar los contenedores**
   ```
   docker compose up -d
   ```
3. Verificar los servicios
   ```
   docker ps
   ```
4. Acceder a la aplcacion

   ```
    http://localhost:8080
   ```

### Ejemplo de configuración para el entorno Docker:

```
# Entorno general
APP_ENV=production

# Base de datos
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=ni_robots
DB_USERNAME=root
DB_PASSWORD=yourpassword

# Credenciales internas de MySQL para Docker
MYSQL_ROOT_PASSWORD=yourpassword

```


---

##  Notas importantes

-  **Configuración de entornos:**  
  El proyecto utiliza **dos archivos `.env`**:  
  1. Uno dentro de la carpeta `Ni.Robots/` (para Laravel).  
  2. Otro en la raíz del proyecto (para Docker).  
  Esto permite desplegar tanto en entornos locales como en producción con diferentes configuraciones de base de datos.

-  **Contenedores independientes:**  
  Los servicios están orquestados mediante **Docker Compose**, incluyendo `php`, `nginx` y `db`.  
  Si algún contenedor falla al iniciar, puede verificarse con:  
  ```
  docker compose logs <servicio>
  ```

 **Compatibilidad**  
- Requiere **PHP ≥ 8.3.0**, **Node.js ≥ 18** y **Docker ≥ 24**.  
- En versiones anteriores pueden fallar dependencias de **Composer** o **Vite**.

 **Chatbot inteligente**  
- El asistente con **OpenAI** está entrenado con información interna de la plataforma para orientar a nuevos usuarios sobre funciones y módulos disponibles.

 **Módulo Médico**  
- Permite agendar **citas presenciales y virtuales**, generar **reportes** y mantener un **historial clínico** seguro del paciente.

 **Módulo Ventas (E-commerce)**  
- Integra la **API de PayPal** para pagos y cuenta con **reportes** para fabricantes y administradores.

 **Módulo Educación**  
- Sección de lectura libre con **artículos y libros** administrados por el **administrador** del sistema.

 **Administración**  
- Panel interno que centraliza la gestión de **usuarios**, **médicos**, **citas**, **libros**, **productos** y **estadísticas** generales.

  
   
