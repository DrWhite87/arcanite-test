## Тестовое задание

Реализовать CRUD-интерфейс списка пользователей и их платежей на Laravel и Vue.js
Сделать возможность редактирования данных пользователя (email, имя, номер телефона) и просмотра его платежей
1. Весь front-end реализовать на Vue.js через API к back-end на Laravel
2. Всё должно быть под авторизацией, в т.ч. API
   
API:
- GET /users
- GET /users/1
- POST /users
- DELETE /users
- GET /users/1/payments

## Стек

Backend:
- PHP 8
- [Laravel 9](https://laravel.com/)
- [Laravel-data](https://spatie.be/docs/laravel-data/v3/introduction)
- [Enum](https://spatie.be/docs/enum/v3/introduction)
- [Laravel Sanctum](https://laravel.com/docs/9.x/sanctum)
  
Database:
- MySQL 8
  
Frontend:
- [Vite](https://vitejs.dev/)
- [Vue 3](https://vuejs.org/)
- [Vue Router](https://router.vuejs.org/)
- [Pinia](https://pinia.vuejs.org/)
- [Bootstrap](https://getbootstrap.com/)


## Установка
1. Установка пакетов composer
```
$ composer install
```
2. Настройка подключения к БД файле .env (создайте, если не существует)
3. Миграция 
```
$ php artisan migrate
```
4. Заполнение БД тестовыми данными
```
$ php artisan db:seed
```
5. Добавить запись о домене для sanctum в .env файл
```
$ SANCTUM_STATEFUL_DOMAINS=ваш домен
```

## Тестовый адрес

https://cyberzilla.stopugroza.ru/

```
Login: admin@admin.com
Password: password
```
