# Start Laravel Sail
start:
	./vendor/bin/sail up -d

# Stop Laravel Sail
stop:
	./vendor/bin/sail down

# Restart Laravel Sail
restart: stop start

# Build
build: /vendor/bin/sail build

# Build no cache
build-no-cache:
	/vendor/bin/sail build --no-cache

# Install PHP dependencies
install:
	./vendor/bin/sail composer install

# Update PHP dependencies
update:
	./vendor/bin/sail composer update

# Run database migrations
migrate:
	./vendor/bin/sail artisan migrate

# Rollback database migrations
rollback:
	./vendor/bin/sail artisan migrate:rollback

# Run database seeders
seed:
	./vendor/bin/sail artisan db:seed

# Clear cache
clear-cache:
	./vendor/bin/sail artisan cache:clear

# Generate application key
key:
	./vendor/bin/sail artisan key:generate

# Show Laravel Sail logs
logs:
	./vendor/bin/sail logs -f

# Execute a shell in the workspace container
shell:
	./vendor/bin/sail shell

# Run tests
test:
	./vendor/bin/sail test

# Run pint
pint:
	./vendor/bin/pint

# Default target
default: start
