#!/usr/bin/env bash

WORK_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )"/.. && pwd )"; [ -h "${WORK_DIR}/${0}" ] && DIR=readlink -n "${WORK_DIR}/${0}"

composer="php /usr/local/bin/composer"

echo "Current env: ${APP_ENV}"

cd ${WORK_DIR}

if [ "${APP_ENV}" == "prod" ]; then
    $composer install --no-dev --optimize-autoloader --classmap-authoritative
    npm install --only=production
    npm run build
else
    $composer install
    npm install
    npm run dev
fi

if [[ $* != *"--skip-migration"* ]]
then
    php bin/console doctrine:migrations:migrate --allow-no-migration --no-interaction
    bin/console cache:clear --no-warmup
fi

if [ "${APP_ENV}" == "prod" ]; then
    bin/console cache:warmup
fi