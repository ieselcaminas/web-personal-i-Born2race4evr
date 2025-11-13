# Proyecto Symfony - Gestión de Coches y Marcas

## Descripción General

Este proyecto es una aplicación web desarrollada con **Symfony** que implementa un sistema **CRUD completo (Crear, Leer, Actualizar y Eliminar)** para gestionar coches y marcas.  

El objetivo es ofrecer una interfaz sencilla y moderna que permita:
- Registrar nuevas marcas y coches.
- Listar los registros existentes.
- Editar o eliminar elementos desde una interfaz amigable.
- Navegar de forma fluida entre las secciones gracias a rutas bien definidas y formularios con validación.

---

## Estructura del Proyecto

El sistema cuenta con dos entidades principales:

### **1. Marca**
Representa la marca de un coche (por ejemplo, Ford, Toyota, BMW...).

| Campo | Tipo | Descripción |
|-------|------|--------------|
| id | int | Identificador único |
| nombre | string | Nombre de la marca |

---

### **2. Coche**
Representa un coche perteneciente a una marca determinada.

| Campo | Tipo | Descripción |
|-------|------|--------------|
| id | int | Identificador único |
| modelo | string | Nombre del modelo |
| anio | int | Año de fabricación |
| marca | relation | Relación con la entidad Marca |

---

## Controladores Principales

El proyecto incluye dos controladores:
- `CocheController`
- `MarcaController`

Ambos siguen la misma estructura con rutas RESTful y métodos HTTP adecuados.

### **CocheController**

| Método | Ruta | Acción | Descripción |
|--------|------|--------|-------------|
| `index()` | `/coche/` | GET | Lista todos los coches |
| `new()` | `/coche/new` | GET, POST | Crea un nuevo coche |
| `edit()` | `/coche/{id}/edit` | GET, POST | Edita un coche existente |
| `delete()` | `/coche/{id}` | POST | Elimina un coche |

### **MarcaController**

| Método | Ruta | Acción | Descripción |
|--------|------|--------|-------------|
| `index()` | `/marca/` | GET | Lista todas las marcas |
| `new()` | `/marca/new` | GET, POST | Crea una nueva marca |
| `edit()` | `/marca/{id}/edit` | GET, POST | Edita una marca existente |
| `delete()` | `/marca/{id}` | POST | Elimina una marca |

---

## Formularios

El proyecto utiliza **Symfony Forms** para generar y validar los formularios de creación y edición:

- `CocheType.php`
- `MarcaType.php`

Cada formulario incluye validaciones básicas y widgets estilizados con **Bootstrap 5** para mantener una interfaz limpia y profesional.

---

## Interfaz de Usuario (Twig)

Las vistas están desarrolladas con **Twig**, usando plantillas reutilizables y estilos de **Bootstrap**.

### **Páginas principales**
- `home.html.twig`: Página de bienvenida con animaciones y botones de navegación.
- `coche/index.html.twig`: Lista los coches registrados.
- `marca/index.html.twig`: Lista las marcas disponibles.
- `coche/new.html.twig`, `coche/edit.html.twig`: Formularios para agregar o editar coches.
- `marca/new.html.twig`, `marca/edit.html.twig`: Formularios para agregar o editar marcas.

### **Elementos destacados**
- Botones con iconos (`Bootstrap Icons`) para **editar** y **eliminar**.
- Formularios protegidos con **CSRF tokens** para mayor seguridad.
- Mensajes flash (`$this->addFlash()`) para mostrar confirmaciones y errores.
- Estilo visual uniforme con tarjetas (`card`) y tablas (`table-hover`, `table-bordered`).

---

## Flujo del CRUD

1. El usuario accede a `/coche` o `/marca` para ver la lista.
2. Puede crear un nuevo elemento mediante el botón **“Nuevo”**.
3. En cada fila de la tabla hay botones para:
   - **Editar:** redirige a un formulario para actualizar datos.
   - **Eliminar:** solicita confirmación antes de borrar el registro.
4. Tras cada acción, se muestra un mensaje de éxito o error.

---

## 💾 Base de Datos

El proyecto utiliza **Doctrine ORM** para gestionar la base de datos.

Comandos útiles:
```bash
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
