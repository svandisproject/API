web: vendor/bin/heroku-php-nginx -C nginx_app.conf web/
assets: bin/console svandis:assets:sync
volumes: bin/console svandis:volumes:sync
icos: bin/console svandis:icos:sync
web_statistics: bin/console svandis:statistic:update