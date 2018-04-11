# Svandis API [![Build Status](https://travis-ci.com/svandisproject/API.svg?token=5bX83yxPS5NXGDqxFHCw&branch=master)](https://travis-ci.com/svandisproject/API) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/svandisproject/API/badges/quality-score.png?b=master&s=6bbd504204acabc116010ba60e20dbc26da8f91f)](https://scrutinizer-ci.com/g/svandisproject/API/?branch=master)[![Code Coverage](https://scrutinizer-ci.com/g/svandisproject/API/badges/coverage.png?b=master&s=99b706014b9195c57e84a0e5d714c7c3007ef6c0)](https://scrutinizer-ci.com/g/svandisproject/API/?branch=master)

## Installation
Considering you have php, composer, mysql, node, npm and yarn installed

```bash
composer install
yarn

mkdir var/jwt
openssl genrsa -out var/jwt/private.pem -aes256 4096
openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem
```

## Development server

Run following in your terminal:

```bash
bin/console server:run
yarn run encore dev-server --hot
node socket/index.js
```

## Adding workers
```bash
cd worker
./worker register --secret <your-worker-secret>
```

## Additional Resourses

* [KamiApiCoreBundle documentation](https://github.com/kamilabs/api-core-bundle/blob/master/README.md)
* [Symfony documentation](https://symfony.com)

## Running tests

```bash
vendor/bin/simple-phpunit
```
