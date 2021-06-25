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
# остановить контейнеры и удалить тома
dev-docker-down-clear:
	docker-compose down -v --remove-orphans
# подключится к запущенному контейнеру
dev-docker-nginx-exec:
	docker-compose exec nginx /bin/bash
# удалить вообще все в системе
dev-docker-remove-all-system:
	docker system prune -a
# проверка на наличие обновлений для пакетов в соответствии с зависимостями
dev-composer-outdated:
	docker-compose run --rm php-cli composer outdated --direct
# список установленных composer пакетов
dev-composer-list:
	docker-compose run --rm php-cli composer outdated -a