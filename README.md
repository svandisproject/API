# Svandis API [![Build Status](https://travis-ci.com/svandisproject/API.svg?token=5bX83yxPS5NXGDqxFHCw&branch=master)](https://travis-ci.com/svandisproject/API) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/svandisproject/API/badges/quality-score.png?b=master&s=74b5d2658f6a5adb4b47f840954e177ea065a94a)](https://scrutinizer-ci.com/g/svandisproject/API/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/svandisproject/API/badges/quality-score.png?b=master&s=74b5d2658f6a5adb4b47f840954e177ea065a94a)](https://scrutinizer-ci.com/g/svandisproject/API/?branch=master)
## Installation
Considering you have php, composer, postgres installed

```bash
composer install

bin/generate-token
```

## Creating database
```bash
bin/console doctrine:database:create
bin/console doctrine:schema:create
bin/console khepin:yaml:fixtures:load
```

## Development server

Run following in your terminal:

```bash
bin/console server:run
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
