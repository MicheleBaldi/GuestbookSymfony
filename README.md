# Symfony Docker

A [Docker](https://www.docker.com/)-based installer and runtime for the [Symfony](https://symfony.com) web framework, with full [HTTP/2](https://symfony.com/doc/current/weblink.html), HTTP/3 and HTTPS support.

![CI](https://github.com/dunglas/symfony-docker/workflows/CI/badge.svg)

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Run `docker-compose build --pull --no-cache` to build fresh images
3. Run `docker-compose up` (the logs will be displayed in the current shell)
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker-compose down --remove-orphans` to stop the Docker containers.

## About Project

This project is a simple web application created with Symfony.

It has been created starting from a complete [Docker Enviroment] (https://github.com/dunglas/symfony-docker) 
and has been done following the documentation [Symfony 5: The Fast Track] (https://symfony.com/doc/current/the-fast-track/en/index.html)

There are two entities "Conference" and "Comment", people can add comment to the conferences.
There is also an admin panel,protected by authentication, where the administrator can create conference and comment.

This project is for dev purpose only 

## Note
The admin panel is reachable from the url /admin but is protected by authentication.

To create an admin user you need to execute this script on CLI of PHP container:

bin/console dbal:run-sql "INSERT INTO admin (id, username, roles, password) VALUES (nextval('admin_id_seq'),'admin', '[\"ROLE_ADMIN\"]', '\$2y\$13\$MlzmoZuKiFeVTkR0Z8sWNuSzS3Tz6YcgGlRM4KtzycKvLLOCyYF6O')"

It will create an administrator user with username and password admin