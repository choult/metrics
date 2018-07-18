# Variables
PHP_BIN := php
COMPOSER_BIN := composer
TIMEZONE ?= UTC

test: install validate quality

# Targets
help:
	@echo ""
	@echo "make server    		> run a set of Docker containers for development and testing"
	@echo "make server_down 	> Shut down the Docker containers"
	@echo ""
	@echo "make help                   > display help"

server:
	@mkdir -p logs .data || true
	@chmod -R a+wr .data var logs || true
	@TIMEZONE=$(TIMEZONE) docker-compose down --remove-orphans
	@TIMEZONE=$(TIMEZONE) docker-compose build
	@TIMEZONE=$(TIMEZONE) docker-compose up -d
	@echo "\nServer available at http://localhost:4000"

server_down:
	@TIMEZONE=$(TIMEZONE) docker-compose down --remove-orphans
