Symfony KAMI Edition
==========

Starter template for KAMI Labs applications

Under the hood:
* KamiApiCoreBundle - For easy CRUD API resources generation
* Vue.js with configured encore
* UiKit an awesome frintend framework 


## Installation
Considering you have php, composer, mysql, node, npm and yarn installed

```bash
composer install
yarn
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

* [KamiApiCoreBundle documentation](src/Kami/ApiCoreBundle/README.md)
* [Symfony documentation](https://symfony.com)