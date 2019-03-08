# authorization_laravel5
Group of classes for roles, actions and users.


Install with docker

docker-compose up --build
docker run --rm --interactive --tty --volume $PWD:/app composer install
sudo chmod -R 777 storage
docker run -it --rm --name my-running-script1 -v $PWD:/usr/src/myapp -w /usr/src/myapp php:7.2.6-apache-stretch php artisan key:generate

After that we need enter to container like this.

docker exec -it auth_laravel bash

# For DB migration
php artisan migrate:refresh --seed --force
