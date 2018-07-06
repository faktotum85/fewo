# Local set-up
- clone the repo
- create a copy of docker-compose.override.dev.yml, rename to docker-compose.override.yml and tweak if needed
- create a copy of .env.dist, rename to .env and update MAILER_URL and DATABASE_URL
- run docker-compose up -d to build docker containers and bring them up
- run docker-compose exec -u dev php bash to get into the php container as user dev.
- inside the container, cd sf4 and run composer install

# Accessing the admin page
- to access the admin menu, add a user with an encrypted password to the database (by hand for now)
- to encrypt the password run bin/console security:encode password