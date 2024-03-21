
## Запуск
```bash
  git clone https://github.com/MishaEn/cnsLoyalty
```
```bash
  cd cnsLoyalty
```
```bash
  docker-compose up -d
```
```bash
  cd api
```
```bash
  composer install
```
Перед перезапуском контейнеров удалить ./configs/db/mysql
## Запуск тестов

```bash
  cd api
```
```bash
  composer test
```


## API

#### Добавить пользователя в группу

```http
  POST /api/v1/groups/users
```

| Parameter  | Type    | Description                |
|:-----------|:--------|:---------------------------|
| `groupId`  | `int`   | Идентификатор группы       |
| `userId`   | `int`   | Идентификатор пользователя |

#### Удалить пользователя из группы

```http
  DELETE /api/v1/groups/:groupId/users/:userId
```

| Parameter  | Type    | Description                |
|:-----------|:--------|:---------------------------|
| `groupId`  | `int`   | Идентификатор группы       |
| `userId`   | `int`   | Идентификатор пользователя |

#### Список пользователей группы

```http
  GET /api/v1/groups/:groupId/users
```

| Parameter | Type    | Description            |
| :-------- |:--------|:-----------------------|
| `groupId` | `int`   | Идентификатор группы   |

#### Список прав пользователя

```http
  GET /api/v1/users/:userId/permissions
```

| Parameter  | Type    | Description                  |
|:-----------|:--------|:-----------------------------|
| `userId`   | `int`   | Идентификатор пользователя   |

## Пример

#### Добавить пользователя в группу
```bash
http://localhost:8080/api/v1/groups/users

{
    "status": "success",
    "code": 200,
    "msg": "ok"
}
```
#### Список пользователей группы
```bash
http://localhost:8080/api/v1/groups/1/users

{
    "status": "success",
    "code": 200,
    "msg": "ok",
    "data": [
        {
            "userId": 1,
            "userName": "Vasya"
        }
    ]
}
```
#### Список прав пользователя
```bash
http://localhost:8080/api/v1/users/1/permissions

{
    "status": "success",
    "code": 200,
    "msg": "ok",
    "data": [
        {
            "name": "send_messages",
            "hasPermission": "true"
        },
        {
            "name": "service_api",
            "hasPermission": "false"
        },
        {
            "name": "debug",
            "hasPermission": "false"
        }
    ]
}
```
#### Удалить пользователя из группы
```bash
http://localhost:8080/api/v1/groups/1/users/2

{
    "status": "success",
    "code": 200,
    "msg": "ok"
}
```
#### 404
```bash
http://localhost:8080/api/v1/permissions

Вернет ответ с 404 кодом
```

