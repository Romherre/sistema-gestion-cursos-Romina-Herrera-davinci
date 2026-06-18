# Sistema de Gestión de Cursos y Alumnos 🎓 - Trabajo Final

Sistema desarrollado en **Laravel 9** para la gestión académica, permitiendo el control de alumnos, docentes, cursos, inscripciones, evaluaciones y materiales didácticos.

## 📊 Modelo de Datos

El sistema se basa en el siguiente diagrama Entidad-Relación:
[Ver diagrama en Canva](https://www.canva.com/design/DAG7zzyLdG0/ZGxBgv1lOf4QSnG9-03ymA/edit?utm_content=DAG7zzyLdG0&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton)

## 🛠️ Tecnologías

- **Laravel 9** (PHP)
- **MySQL**
- **Composer**

## 🚀 Instalación

1. Clonar el repositorio.
2. Instalar dependencias: `composer install`.
3. Configurar base de datos en `.env` (MySQL).
4. Ejecutar migraciones y datos de prueba: `php artisan migrate --seed`.
5. Configurar archivos adjuntos: `php artisan storage:link`.

Al ser un proyecto backend en Laravel, no tiene demo en vivo vía GitHub Pages (no soporta PHP).

## ✅ Validaciones de Negocio Implementadas

- **Docentes:** máximo de 3 cursos activos permitidos por docente.
- **Cursos:** validación de cupos máximos para evitar sobre-inscripción.
- **Alumnos:** edad mínima de 16 años para el alta.
- **Archivos:** validación de formatos PDF, DOCX, PPT, JPG y PNG para adjuntos.

## 👥 Perfiles de Usuario

- **Administrador:** acceso total a ABM de Alumnos, Docentes, Cursos y Archivos.
- **Coordinador:** gestión de Inscripciones y carga de Evaluaciones por curso.

## Contacto

- **Nombre:** Romina Herrera
- **Correo electrónico:** romina-herrera@hotmail.com
- **LinkedIn:** https://www.linkedin.com/in/romina-herreramicv/
