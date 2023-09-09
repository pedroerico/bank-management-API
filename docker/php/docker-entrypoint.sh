#!/bin/bash
set -e

#
mkdir -p /var/www

rm /var/www/var/*.db || true

if [ ! -f /var/www/.env ]; then
    cp .env.example .env
fi

if [ ! -f /var/www/docker-compose.yml ]; then
    cp docker-compose.yml.sample docker-compose.yml
fi

composer i -o

php /var/www/artisan migrate

if [ ! -f /var/www/.seeded ]; then
    php /var/www/artisan db:seed
    touch /var/www/.seeded
fi

chmod -R o+s+w /var/www

exec "$@"
