# поднимаем все
up: dev-docker-up
# останавливаем контейнеры
down: dev-docker-down
# скачать образы
dev-docker-pull:
	docker-compose pull
# сборка образов
dev-docker-build:
	docker-compose build
# собрать образы + проверить на наличие новых версии образов
dev-docker-build-pull:
	docker-compose build --pull
# запуск контейнеров в фоновом режиме
dev-docker-up:
	docker-compose up -d
# остановить контейнеры поднятые командой docker-compose up
dev-docker-down:
	docker-compose down --remove-orphans
# перезапустить контейнеры
dev-docker-restart:
	docker-compose restart
# остановить контейнеры и удалить тома
dev-docker-down-clear:
	docker-compose down -v --remove-orphans
# подключится к запущенному контейнеру
dev-docker-nginx-exec:
	docker-compose exec nginx /bin/bash
# удалить вообще все в системе
dev-docker-remove-all-system:
	docker system prune -a
# проверка на наличие обновлений для пакетов в соответствии с зависимостями для бэкенда
dev-composer-outdated:
	docker-compose run --rm php-cli composer outdated --direct
# список установленных composer пакетов
dev-composer-list:
	docker-compose run --rm php-cli composer outdated -a
# Обновить карту классов composer по умолчанию
dev-composer-autoload:
	docker-compose run --rm php-cli composer dump-autoload
# Обновить карту классов composer для прода без dev зависимостей
dev-composer-autoload-no-dev:
	docker-compose run --rm php-cli composer dump-autoload --no-dev
# Запуск тестов phpunit
dev-composer-test:
	docker-compose run --rm php-cli composer test
# Запуск команды test в консоли
dev-composer-console:
	docker-compose run --rm php-cli composer console test
# Загрузка фикстур
dev-composer-console-fixture:
	docker-compose run --rm php-cli composer console fixtures:load
# Запуск валидации схемы базы данных doctrine pgsql
dev-composer-doctrine-pgsql-validate-schema:
	docker-compose run --rm php-cli composer doctrine-pgsql orm:validate-schema
# Создание таблиц на основе схемы базы данных pgsql
dev-composer-doctrine-pgsql-create-schema:
	docker-compose run --rm php-cli composer doctrine-pgsql orm:schema-tool:create
# Удаление таблиц на основе схемы базы данных pqsql
dev-composer-doctrine-pgsql-drop-schema:
	docker-compose run --rm php-cli composer doctrine-pgsql orm:schema-tool:drop -- --force
# создание миграций
dev-composer-doctrine-pgsql-migration-diff:
	docker-compose run -u 1000:1000 --rm php-cli composer doctrine-pgsql migrations:diff
# Запуск валидации схемы doctrine mysql
dev-composer-doctrine-mysql-validate-schema:
	docker-compose run --rm php-cli composer doctrine-mysql orm:validate-schema
# Создание таблиц на основе схемы базы данных mysql
dev-composer-doctrine-mysql-create-schema:
	docker-compose run --rm php-cli composer doctrine-mysql orm:schema-tool:create
# Удаление таблиц на основе схемы базы данных mysql
dev-composer-doctrine-mysql-drop-schema:
	docker-compose run --rm php-cli composer doctrine-mysql orm:schema-tool:drop -- --force
# создание миграций
dev-composer-doctrine-mysql-migration-diff:
	docker-compose run -u 1000:1000 --rm php-cli composer doctrine-mysql migrations:diff
# проверка на наличие обновлений для пакетов в соответствии с зависимостями для фронтенда
dev-yarn-outdated:
	docker-compose run --rm node-cli yarn outdated
# очистка папки build во фронтенде
dev-frontend-clear:
	docker-compose run --rm node-cli /bin/bash -c 'rm -rf build'
# сборка проекта
dev-yarn-build:
	docker-compose run --rm node-cli yarn build
# запуск тестов фронтенда в интерактивном режиме
dev-yarn-test-watch:
	docker-compose run --rm node-cli yarn test
# запуск тестов фронтенда без слежения за изменяемыми файлами
dev-yarn-test-no-watch:
	docker-compose run --rm node-cli yarn test --watchAll=false
# линтер js файлов
dev-yarn-jslint:
	docker-compose run --rm node-cli yarn eslint
# исправление js файлов
dev-yarn-jslint-fix:
	docker-compose run --rm node-cli yarn eslint-fix
# линтер css файлов
dev-yarn-csslint:
	docker-compose run --rm node-cli yarn stylelint
# исправление файлов фронтенда, только code style
dev-yarn-prettier:
	docker-compose run --rm node-cli yarn prettier
# запуск тестов cucumber
dev-cucumber-e2e-run:
	docker-compose run --rm node-cli yarn e2e
# пингуем продакшеновские серваки
prod-ping:
	cd infrastructure/production/ansible && $(MAKE) ping
# гасим продакшеновские сервера
prod-poweroff:
	cd infrastructure/production/ansible && $(MAKE) poweroff
prod-install:
	cd infrastructure/production/ansible && $(MAKE) install
prod-uninstall:
	cd infrastructure/production/ansible && $(MAKE) uninstall
prod-debug:
	cd infrastructure/production/ansible && $(MAKE) debug