## Бэклог: интеграция MODX API → Laravel

### 1. Модель `ModxApiClient`
- Метод `getStructure()` — делает HTTP запрос к вашему `api.php?action=get_structure`
- Метод `getPage(int $id)` — запрос к `api.php?action=get_page&id=X`
- Базовый URL и токен берёт из `.env`

### 2. Маршрут
- `GET /structure` → `StructureController@index`

### 3. Контроллер `StructureController`
- Вызывает `ModxApiClient::getStructure()`
- Возвращает JSON или передаёт данные во View

---

## Распределение ответственности

| Слой | Что делает |
|---|---|
| `api.php` (MODX) | Достаёт данные из БД |
| `ModxApiClient` (Model/Service) | HTTP-клиент, общается с api.php |
| `Controller` | Получает данные от модели, отдаёт ответ |
| `View` | Позже, когда понадобится отображение |

---

## Порядок выполнения

1. Добавить в `.env` — `MODX_API_URL` и `MODX_API_TOKEN`
2. Создать `app/Services/ModxApiClient.php` с методом `getStructure()`
3. Создать маршрут в `routes/web.php`
4. Создать `StructureController` с методом `index()`
5. Проверить что `/structure` возвращает JSON

---
