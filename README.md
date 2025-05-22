# Laravel + Vite Message Queue Project

## Описание проекта

Проект реализует систему обработки коротких сообщений (твитов) с использованием очереди сообщений (Message Queue).

- Backend: Laravel (PHP-FPM)
- Frontend: Vue 3 (Composition API)
- База данных: MySQL
- Кэш и очередь: Redis
- Веб-сервер: Nginx
- Обработка очереди — worker на Laravel queue
- Реальное время — WebSocket-сервер (Reverb)

Пользователь может выбирать категорию твитов, отправлять новые сообщения, которые попадают в очередь и затем обрабатываются слушателем, автоматически добавляющим их в базу. Отображение твитов происходит в реальном времени.

## Структура проекта

    .
    ├── backend/ # Laravel backend
    ├── frontend/ # Vue 3
    ├── deployment/ # Docker, Nginx, конфигурации для докеризации
    ├── docker-compose.yaml # Основной docker-compose для запуска всего стека
    └── README.md # Документация проекта

## Требования

- Docker и Docker Compose (версии >= 20.10)
- Git

## Быстрый старт

1. Клонируйте репозиторий:
   git clone https://github.com/yourusername/yourproject.git cd yourproject/deployment`

2. Запустите все сервисы командой:

`docker-compose up --build`

3.  После старта:

- Backend доступен по адресу: `http://localhost/`
- Frontend (Vite dev server): `http://localhost:5173/`
- WebSocket сервер: порт `8080`
- MySQL: порт `3306`
- Redis: порт `6379`

4.  Для остановки:

`docker-compose down`

## Архитектура и компоненты

- **Nginx** — обратный прокси и веб-сервер для Laravel.

- **MySQL** — хранит данные категорий и твитов.
- **Redis** — брокер очереди сообщений.
- **Laravel Queue Worker** — прослушивает очередь и обрабатывает новые сообщения, записывая их в базу.
- **WebSocket сервер (Reverb)** — отвечает за push-уведомления твитов в режиме реального времени.

- **Frontend** — позволяет выбирать категории, отправлять твиты, просматривать их в реальном времени.

## Таблицы базы данных

- `categories`

  - `id` (PK)
  - `title` (string)

- `tweets`

  - `id` (PK)
  - `category_id` (FK)
  - `username` (string)
  - `content` (text)
  - `created_at` (timestamp)

## Очередь сообщений

- Настроена с использованием Redis драйвера.
- Laravel Queue Worker запускается через команду `php artisan queue:work`.
- Новые твиты отправляются в очередь, где слушатель их обрабатывает и сохраняет в базу.

## CI/CD

Для автоматизации сборки и тестирования используется GitHub Actions. Пайплайн запускается при любом пуше и на pull request в ветку `main`.

Основные шаги пайплайна:

- Клонирование репозитория
- Настройка Docker Buildx и кэширование Docker слоев
- Сборка всех Docker образов с передачей UID/GID
- Запуск контейнеров в фоне
- Копирование `.env` файла для Laravel
- Установка backend зависимостей через Composer
- Генерация APP_KEY для Laravel
- Запуск миграций базы данных
- Запуск PHPUnit тестов backend
- PHP Lint и статический анализ (Pint, PHPStan)
- Установка frontend зависимостей
- Запуск frontend юнит-тестов (Vitest)
- (Опционально) Cypress e2e тесты (закомментированы)
- Остановка и удаление контейнеров по завершении
