# Sistema de Gestión de Cursos y Alumnos 🎓 - Trabajo Final

[cite_start]Este sistema ha sido desarrollado en **Laravel 9** para la gestión académica, permitiendo el control de alumnos, docentes, cursos, inscripciones, evaluaciones y materiales didácticos[cite: 1, 2].

## 📊 Modelo de Datos
El sistema se basa en el siguiente diagrama Entidad-Relación
https://www.canva.com/design/DAG7zzyLdG0/ZGxBgv1lOf4QSnG9-03ymA/edit?utm_content=DAG7zzyLdG0&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton

## 🛠️ Requerimientos Técnicos e Instalación
1. Clonar el repositorio.
2. Instalar dependencias: `composer install`.
3. Configurar base de datos en `.env` (MySQL).
4. Ejecutar migraciones y datos de prueba: `php artisan migrate --seed`.
5. [cite_start]**Configurar archivos adjuntos:** `php artisan storage:link`

## ✅ Validaciones de Negocio Implementadas
[cite_start]Para cumplir con la consigna, se han programado las siguientes reglas 
- [cite_start]**Docentes**: Máximo de 3 cursos activos permitidos por docente
- [cite_start]**Cursos**: Validación de cupos máximos para evitar sobre-inscripción
- [cite_start]**Alumnos**: Edad mínima de 16 años para el alta
- [cite_start]**Archivos**: Validación de formatos PDF, DOCX, PPT, JPG y PNG para adjuntos

## 👥 Perfiles de Usuario
- [cite_start]**Administrador**: Acceso total a ABM de Alumnos, Docentes, Cursos y Archivos
- [cite_start]**Coordinador**: Gestión de Inscripciones y carga de Evaluaciones por curso

