# README — Proyecto Final Vue + Laravel

## Descripción

Proyecto SPA desarrollado con:
* Laravel (API REST)
* Vue 3
* Vue Router
* Pinia
* Axios

El sistema incluye:
* CRUD de productos
* Catálogo dinámico
* Carrito de compras
* Login básico
* Rutas protegidas
* Subida de imágenes
* Persistencia con localStorage

# Requisitos

Antes de ejecutar el proyecto se necesita instalar:
* PHP 8+
* Composer
* Node.js
* npm
* MySQL o MariaDB


# Estructura del proyecto
proyecto/
│
├── practica1-api
│
└── practica1-frontend

# Backend Laravel

## 1. Entrar a la carpeta backend
cd practica1-api

## 2. Instalar dependencias
composer install


## 3. Configurar archivo .env

Crear el archivo `.env` condifurando:
.env
DB_DATABASE=nombre_bd
DB_USERNAME=root
DB_PASSWORD=


## 4. Generar key
php artisan key:generate

## 5. Ejecutar migraciones
php artisan migrate

## 6. Ejecutar seeders (opcional)
php artisan db:seed

## 7. Crear storage link
php artisan storage:link

## 8. Ejecutar servidor Laravel
php artisan serve

El backend quedará disponible en: http://127.0.0.1:8000

# Frontend Vue
## 1. Entrar a la carpeta frontend
cd practica1-frontend-estable

## 2. Instalar dependencias
npm install

## 3. Ejecutar servidor Vue
npm run dev

El frontend quedará disponible en: http://localhost:5173


# Funcionalidades principales

## CRUD de productos

Permite:

* crear productos
* editar productos
* eliminar productos
* subir imágenes

---

## Catálogo

Incluye:

* búsqueda
* paginación
* detalle dinámico
* imágenes

---

## Carrito

Incluye:
* agregar productos
* eliminar productos
* modificar cantidades
* total reactivo
* persistencia localStorage

## Login

El sistema utiliza autenticación básica con token almacenado en localStorage para proteger rutas administrativas.

# Rutas principales

## Frontend
/catalogo
/catalogo/:id
/carrito
/login
/admin

## API
/api/productos
/api/pedidos

# Tecnologías utilizadas

## Backend

* Laravel
* Eloquent ORM
* MySQL

## Frontend

* Vue 3
* Vue Router
* Pinia
* Axios
* Vite
