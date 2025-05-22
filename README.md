## Установка

- Клонируем репозиторий `git clone git@github.com:moonpie510/performers-orders-api.git`
- Переходим в папку с проектом
- Создаем .env на основе .env.example
- Запускаем докер `docker compose up -d`
- Заходим в контейнер `docker exec -it skilla_php-fpm bash`
- Запускаем `npm i`
- Запускаем `composer install`
- `php artisan storage:link`
- `chmod 777 -R ./storage`
- `chmod 777 -R ./bootstrap/cache`
- Генерируем ключ для приложения `php artisan key:generate`
- Запускаем миграции с сидами `php artisan migrate --seed`
- Создайте тестовую БД `php artisan test:create-schema`
- Генерируем ключи шифрования для passport `php artisan passport:keys`
- `chmod 777 -R ./storage`
- Создайте ключи для passport `php artisan passport:client --personal`, а далее вставьте их в .env в `PASSPORT_PERSONAL_ACCESS_CLIENT_ID` и `PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET`
- Запускаем `npm run dev`
- Открываем дргую вкладку терминала и заходим в контейнер `docker exec -it skilla_php-fpm bash` и заускаем `php artisan reverb:start`
- Опять открываем дргую вкладку терминала и заходим в контейнер `docker exec -it skilla_php-fpm bash` и заускаем `php artisan test`

## Тесты
- Для запуска тестов нужно создать тестовую БД командой `php artisan test:create-schema`.
- Запустить тесты можно `php artisan test`

## WebSockets
- Для работы вебсокетов нужно запустить `php artisan reverb:start`.

## Роуты
1) ### Логин менеджера
```http
POST /api/v1/auth/user/login
```

| Параметр   | Тип      | Описание                 |
|:-----------|:---------|:-------------------------|
| `email`    | `email`  | **Обязательный**. Почта  |
| `password` | `string` | **Обязательный**. Пароль |

2) ### Регистарция менеджера
```http
POST /api/v1/auth/user/register
```

| Параметр                | Тип      | Описание                                     |
|:------------------------|:---------|:---------------------------------------------|
| `name`                  | `string` | **Обязательный**. Имя                        |
| `email`                 | `email`  | **Обязательный**. Почта                      |
| `password`              | `string` | **Обязательный**. Пароль                     |
| `password_confirmation` | `string` | **Обязательный**. Пароль подтверждение       |
| `partnership_id`        | `int`    | **Обязательный**. id из таблицы partnerships |

3) ### Выход из аккаунта менеджера
```http
POST /api/v1/auth/user/logout
```

4) ### Получение активных сессий менеджера
```http
GET /api/v1/auth/user/sessions
```

5) ### Закрытие выбранной сесии
```http
DELETE /api/v1/auth/user/sessions/{id}
```
id - id сессии которую нужно закрыть

6) ### Создание заказа
```http
POST /api/v1/orders
```

| Параметр         | Тип      | Описание                                               |
|:-----------------|:---------|:-------------------------------------------------------|
| `type_id`        | `int`    | **Обязательный**. Идентификатор типа заказа            |
| `partnership_id` | `int`    | **Обязательный**. Идентификатор партнера               |
| `user_id`        | `int`    | **Обязательный**. Идентификатор менеджера              |
| `description`    | `string` | **Обязательный**. Описание                             |
| `date`           | `string` | **Обязательный**. Дата                                 |
| `address`        | `string` | **Обязательный**. Адрес                                |
| `amount`         | `int`    | **Обязательный**. Стоимость                            |

7) ### Назначить исполнителя на заказ
```http
POST /api/v1/orders/assign-worker
```

| Параметр    | Тип   | Описание                                    |
|:------------|:------|:--------------------------------------------|
| `worker_id` | `int` | **Обязательный**. Идентификатор исполнителя |
| `order_id`  | `int` | **Обязательный**. Идентификатор заказа      |

8) ### Поменять статус заказа
```http
PUT /api/v1/orders/{order}/status
```

order - id заказа

| Параметр | Тип      | Описание                              |
|:---------|:---------|:--------------------------------------|
| `status` | `string` | **Обязательный**. Новый статус заказа |

9) ### Получить отфильтрованный список исполнителей
```http
GET /api/v1/workers
```

| Параметр         | Тип   | Описание                                             |
|:-----------------|:------|:-----------------------------------------------------|
| `order_type_ids` | `int` | **Обязательный**. Массив идентификаторов типа заказа |

10) ### Авторизовать исполнителя. Возвращает токен который нужен для работы вебсокетов
```http
POST /api/v1/workers/{id}/login
```
id - id исполнителя
