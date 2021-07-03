# Pure

## Построение модульной архитектуры проекта с разделением на backend и frontend

## Запуск проекта с нуля

1. Склонировать проект командой `git clone git@github.com:LexusAlex/pure.git`.
2. Выполнить команду `make dev-docker-up` которая проделает следующее:
    - скачает docker образы `make dev-docker-build-pull`.
    - соберет контейнеры на основании docker-compose файла.
    - запустит контейнеры в фоновом режиме.
3. Выполнить `docker-compose run --rm php-cli composer install`, для установки зависимостей composer (всегда используйте composer install)
4. Выполнить `docker-compose run --rm node-cli yarn install`, для установки зависимостей фронтенда
    
_вся процедура займет не больше 5 минут._

## Запуск/Остановка контейнеров

- запустить контейнеры `make dev-docker-up`
- остановить контейнеры `make dev-docker-down`
