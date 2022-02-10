DC_FILENAME = docker-compose.yml
DC_FILENAME_MAC = docker-compose-for-mac.yml
USER := $(shell id -u)
GROUP := $(shell id -g)
WHOAMI = $(USER):$(GROUP)

.PHONE: build kill clean exec composer

build:
	docker compose -f $(DC_FILENAME) up -d

kill:
	docker compose -f $(DC_FILENAME) down

build-mac:
	docker compose -f $(DC_FILENAME_MAC) up -d

kill-mac:
	docker compose -f $(DC_FILENAME_MAC) down

kill-mac-vol:
	docker compose -f $(DC_FILENAME_MAC) down -v

clean-vol:
	docker volume rm -f $(docker volume ls -q)

terminal:
	docker exec -it fpm-app /bin/sh

composer-install:
	docker compose exec app composer install \
	--no-cache --ignore-platform-reqs
