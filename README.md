# SEO Automation App

PHP-приложение для автоматизации рутинных SEO-задач с AI-генерацией контента.

## Текущий статус

**Phase 0: MVP Framework Foundation** — базовый каркас приложения

## Технологии

- **PHP 8.4** (FPM)
- **Nginx 1.26**
- **MySQL 8.4**
- **Docker Compose**

### Зависимости

- `nikic/fast-route` — роутинг
- `symfony/http-foundation` — HTTP Request/Response
- `symfony/var-dumper` — отладка (dev)

## Структура проекта

```
├── docker/                 # Docker-конфигурация
│   ├── Dockerfile          # PHP 8.4-fpm образ
│   ├── docker-compose.yaml
│   └── nginx/nginx.conf
├── framework/              # Собственный микрофреймворк
│   ├── Http/
│   │   └── Kernel.php      # HTTP-ядро приложения
│   ├── Routing/
│   │   ├── Router.php      # Хелперы для маршрутов
│   │   ├── RouteDispatcher.php
│   │   └── RouteDispatcherInterface.php
│   └── Exception/
│       ├── HttpException.php
│       └── MethodNotFoundException.php
├── src/                    # Код приложения
│   ├── App.php
│   └── Controllers/
│       └── HomeController.php
├── routes/
│   └── web.php             # Определение маршрутов
├── public/
│   └── index.php           # Точка входа
├── storage/                # Хранилище (логи, кэш, MySQL данные)
└── vendor/                 # Composer-зависимости
```

## Установка и запуск

```bash
# Клонировать репозиторий
git clone <repo-url>
cd web-seo-helper

# Скопировать конфигурацию окружения
cp .env.example .env

# Запустить контейнеры
cd docker
docker compose up -d

# Установить зависимости
docker compose exec app composer install
```

## Доступ к сервисам

| Сервис      | URL                    |
|-------------|------------------------|
| Приложение  | http://localhost:8000  |
| phpMyAdmin  | http://localhost:8001  |
| MySQL       | localhost:3308         |

## Определение маршрутов

Маршруты определяются в `routes/web.php`:

```php
use App\Controllers\HomeController;use Framework\Routing\Router;

return [
    Router::get('/', [HomeController::class, 'hello']),
    Router::get('/project/{id:\d+}', [HomeController::class, 'project']),
    Router::get('/hi/{name}', function (string $name) {
        return new Response('<h1>Hello ' . $name . '!</h1>');
    }),
];
```

Поддерживаются:
- GET/POST методы
- Параметры в URL с regex-валидацией (`{id:\d+}`)
- Контроллеры и callable-обработчики

## Реализованный функционал (Phase 0)

- [x] Docker-окружение (PHP-FPM + Nginx + MySQL + phpMyAdmin)
- [x] Nginx-конфигурация с поддержкой PHP и увеличенными таймаутами
- [x] Роутинг на базе FastRoute
- [x] HTTP Kernel с обработкой запросов
- [x] Request/Response (Symfony HttpFoundation)
- [x] Базовые HTTP-исключения (404, 405, 500)
- [x] PSR-4 автозагрузка (App\, Framework\)
- [x] Структура проекта

## Дорожная карта

Подробный план разработки см. в [backlog.md](backlog.md).

**Следующие этапы:**
1. Phase 1: AI Provider Abstraction Layer (Anthropic, OpenAI, Gemini, YandexGPT)
2. Phase 2: Генерация SEO-текстов по брифу
3. Phase 3: Генерация Meta Title + Description
4. Phase 4: Prompt Manager

