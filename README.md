# Prueba productos segaci

Desarrollo Backend en Laravel 11.25.0 y MySql => Proyecto API tienda

## Instalar el proyecto de laravel

```sh
composer install
```

### Crear el archivo .env utilizando el .env.example

```sh
cp .env.example .env
```

### Generar una clave unica para el proyecto

```sh
php artisan key:generate
```

### Ejecutar las migraciones para crear la BD y las tablas necesarias

```sh
php artisan migrate
```

### Levantar el servidor

```sh
php artisan serve
```
