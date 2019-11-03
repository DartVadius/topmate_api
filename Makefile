docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build:
	docker-compose up --build -d --force-recreate

composer-install:
	docker-compose exec php-cli composer install

test:
	docker-compose exec php-cli vendor/bin/phpunit

migrate:
	docker-compose exec php-cli php artisan migrate

doc:
	php artisan ide-helper:generate
