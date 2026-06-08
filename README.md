# 🧪 La Perfumoteca - Sistema de Gestión de Perfumes

La Perfumoteca es una aplicación web dinámica diseñada para catalogar, organizar y gestionar colecciones personales de perfumería. Combina un backend sólido en PHP con una base de datos relacional para ofrecer una experiencia personalizada con autenticación de usuarios y colecciones privadas.

Puedes acceder a la aplicación en vivo aquí: **[La Perfumoteca - Web Oficial](https://biblioteca-perfumes.infinityfreeapp.com/)**

## ✨ Funcionalidades Principales

* **Catálogo Dinámico:** Exploración visual y detallada de fragancias, con fichas técnicas que desglosan notas olfativas, marcas y familias.
* **Sistema de Autenticación Seguro:** Registro e inicio de sesión de usuarios mediante la gestión de sesiones nativas de PHP para proteger el acceso a las funciones avanzadas.
* **Colecciones y Listas Privadas:** Cada usuario puede añadir, organizar y gestionar sus propios perfumes dentro de estanterías virtuales privadas (Favoritos, Deseados, Mi Colección) con persistencia de datos.
* **Diseño Fluido y Responsivo:** Interfaz limpia y adaptativa construida desde cero, garantizando una navegación cómoda tanto en pantallas de escritorio como en smartphones.

## 🛠️ Tecnologías Utilizadas

* **Backend:** PHP (Lógica del servidor, control de sesiones y procesamiento de peticiones HTTP).
* **Base de Datos:** MySQL (Modelado relacional para el almacenamiento seguro de usuarios, perfumes y tablas pivote de colecciones).
* **Frontend:** HTML5 semántico y CSS3 estructural.
* **Hosting:** Desplegado y configurado en entornos de producción dentro de InfinityFree.

## 📂 Estructura y Seguridad

Por motivos estrictos de seguridad, las credenciales de conexión a la base de datos se gestionan de forma aislada a través del archivo `db.php`, el cual se encuentra excluido del sistema de control de versiones mediante `.gitignore` para evitar la exposición de datos sensibles. 

Para despliegues de desarrollo, se debe tomar como referencia el archivo de plantilla proporcionado y rellenarlo con las variables de entorno correspondientes.

## 🚀 Instalación y Uso (Desarrollo Local)

Para ejecutar este proyecto en un entorno local utilizando servidores como XAMPP, Laragon o MAMP:

1. Clona este repositorio dentro del directorio raíz de tu servidor local (`htdocs` o `www`).
2. Importa el archivo de estructura de base de datos `.sql` (incluido en el repositorio) en tu gestor de MySQL (phpMyAdmin).
3. Crea el archivo `db.php` en la raíz del proyecto introduciendo las credenciales de tu base de datos local.
4. Abre el navegador y accede a la ruta local correspondiente (ej: `http://localhost/la-perfumoteca`).

---

**Miguel Soto Blanco** *Desarrollador Web*
