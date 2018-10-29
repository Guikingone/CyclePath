# Constants
DOCKER_COMPOSE = docker-compose
DOCKER = docker
GCLOUD = gcloud

## Environments
ENV_PHP = $(DOCKER_COMPOSE) exec php-fpm
ENV_NODE = $(DOCKER_COMPOSE) exec node
ENV_VARNISH = $(DOCKER_COMPOSE) exec varnish
ENV_BLACKFIRE = $(DOCKER_COMPOSE) exec blackfire
COMPOSER = $(ENV_PHP) composer

## Globals commands
start: docker-compose.yml
	$(DOCKER_COMPOSE) build --no-cache
	$(DOCKER_COMPOSE) up -d --build --remove-orphans --force-recreate
	make install
	make cache-clear

restart: docker-compose.yml
	$(DOCKER_COMPOSE) up -d --build --remove-orphans --no-recreate
	make install
	make cache-clear
	make yarn_install

stop: docker-compose.yml
	$(DOCKER) stop $(docker ps -a -q)

cache-clear: var/cache
	$(ENV_PHP) rm -rf var/cache/*

clean: ## Allow to delete the generated files and clean the project folder
	$(ENV_PHP) rm -rf .env ./node_modules ./vendor

## PHP commands
install: composer.json
	$(COMPOSER) install -a -o
	$(COMPOSER) clear-cache
	make autoload

update: composer.lock
	$(COMPOSER) update -a -o

require: composer.json
	$(COMPOSER) req $(PACKAGE) -a -o

require-dev: composer.json
	$(COMPOSER) req --dev $(PACKAGE) -a -o

remove: composer.lock
	$(COMPOSER) remove $(PACKAGE) -a -o

remove-dev: composer.lock
	$(COMPOSER) remove --dev $(PACKAGE) -a -o

autoload: composer.json
	$(COMPOSER) dump-autoload -a -o

## NodeJS commands
yarn_install: package.json
	$(ENV_NODE) yarn install

yarn_require: package.json
	$(ENV_NODE) yarn add $(PACKAGE)

yarn_require_dev: package.json
	$(ENV_NODE) yarn add --dev $(PACKAGE)

encore_watch: webpack.config.js
	$(ENV_NODE) yarn watch

encore_production: webpack.config.js
	$(ENV_NODE) yarn build

## Tools
phpstan: vendor/bin/phpstan
	$(ENV_PHP) vendor/bin/phpstan analyse $(FOLDER) --level $(LEVEL)

## Varnish commands
varnish_logs: ## Allow to see the varnish logs
	$(ENV_VARNISH) varnishlog -b

## Blackfire commands
blackfire_php: public/index.php
	make cache-clear
	make autoload
	$(ENV_BLACKFIRE) blackfire curl http://nginx$(URL) --samples $(SAMPLES)

blackfire_varnish: public/index.php
	make cache-clear
	make autoload
	$(ENV_BLACKFIRE) blackfire curl http://varnish$(URL) --samples $(SAMPLES)

## Tests
phpunit: tests
	$(ENV_PHP) ./bin/phpunit $(FOLDER)
