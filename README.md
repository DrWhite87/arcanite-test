## Тестовое задание

Задание:
Необходимо создать административную панель, которая состоит из единого раздела “Выплаты”.
Описание:
Раздел “Выплаты” должен быть представлен в виде таблицы с полями:

- Логин
- Реквизиты (много текста)
- Сумма
- Валюта
- Статус заявки

Поле “Статус заявки” должно содержать в себе переменную со значениями “Оплачен”/”Не
оплачен”. По умолчанию каждой новой записи в таблице присваивается значение статуса “Не
оплачен”, по клику на это поле через дроп-меню можно изменить значение статуса на
“Оплачен”.

Новые записи в таблице должны появляться через API-метод, через который будут приходить
значения для соответствующих полей в таблице. API должно содержать базовую защиту по
токену.

Требования:
- Backend: PHP + mysql
- Front: Vue + Vuetify
- Срок выполнения: 1 день


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
- [Vuetify](https://next.vuetifyjs.com/en/)


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

## API token

API токен можно получить в своем профиле https://arcanite.stopugroza.ru/profile.

Добавьте токен в заголовки запроса:
```
Authorization: Bearer <token>
```

Токен можно использовать только для создания выплаты:
```
POST /api/payments
{
  "user_id": 1,
  "requisites": "Requisites",
  "amount": "1000.00",
  "currency": "RUB"
}
```


## Тестовый адрес

https://arcanite.stopugroza.ru/

```
Login: admin@admin.com
Password: password
```
