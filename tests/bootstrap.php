<?php

if (isset($_ENV['BOOTSTRAP_REFRESH_DATABASE_ENV'])) {
    // Refresh test database
    exec(sprintf(
        'php "%s/../bin/console" doctrine:database:drop --env=%s --force',
        __DIR__,
        $_ENV['BOOTSTRAP_REFRESH_DATABASE_ENV']
    ));
    exec(sprintf(
        'php "%s/../bin/console" doctrine:schema:create --env=%s',
        __DIR__,
        $_ENV['BOOTSTRAP_REFRESH_DATABASE_ENV']
    ));
    exec(sprintf(
        'php "%s/../bin/console" khepin:yamlfixtures:load -n --env=%s',
        __DIR__,
        $_ENV['BOOTSTRAP_REFRESH_DATABASE_ENV']
    ));

    echo "Database refreshed\n\n";
}


require __DIR__.'/../vendor/autoload.php';