#!/usr/bin/env bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

php $DIR/console doctrine:migrations:migrate
php $DIR/console cache:clear --env=prod