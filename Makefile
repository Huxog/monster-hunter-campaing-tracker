# Docker Compose settings
COMPOSE=docker compose -f docker/docker-compose.yml --env-file ./.env
APP_SERVICE=mh-app-service

# Storage fix commands
chown:
	docker exec $(APP_SERVICE) chown -R 82:82 /var/www/html/storage
	docker exec $(APP_SERVICE) chmod -R 775 /var/www/html/storage

# Laravel Artisan Commands
migrate:
	docker exec $(APP_SERVICE) php artisan migrate

status:
	docker exec $(APP_SERVICE) php artisan migrate:status

fresh:
	docker exec $(APP_SERVICE) php artisan migrate:fresh --seed

seed:
	docker exec $(APP_SERVICE) php artisan db:seed

test:
	docker exec $(APP_SERVICE) php artisan test

key-generate:
	docker exec $(APP_SERVICE) php artisan key:generate

# Composer
install:
	docker exec $(APP_SERVICE) composer install

require:
	docker exec $(APP_SERVICE) composer require $(filter-out $@,$(MAKECMDGOALS))

# Docker Compose controls
build:
	docker compose -f docker/docker-compose.yml --env-file ./.env build

up:
	docker compose -f docker/docker-compose.yml --env-file ./.env up -d

stop:
	docker compose -f docker/docker-compose.yml stop

down:
	docker compose -f docker/docker-compose.yml down

rebuild:
	docker compose -f docker/docker-compose.yml down
	docker compose -f docker/docker-compose.yml --env-file ./.env up -d

logs:
	docker logs -f $(APP_SERVICE)

# Default target
.DEFAULT_GOAL := help

help:
	@echo "Makefile Laravel + Docker Commands:"
	@echo "  make up              - Start and build containers"
	@echo "  make down            - Stop and remove containers"
	@echo "  make stop            - Stop containers"
	@echo "  make build           - Build containers from scratch"
	@echo "  make rebuild         - Rebuild containers and clear volumes"
	@echo "  make logs         	  - See logs of app container"
	@echo "  make migrate         - Run migrations"
	@echo "  make status          - Migration status"
	@echo "  make fresh           - Fresh DB + seed"
	@echo "  make seed            - Run seeders"
	@echo "  make test            - Run tests"
	@echo "  make key-generate    - Run generate app key"
	@echo "  make install         - Run composer install"
	@echo "  make chown           - fix storage access permissions"
