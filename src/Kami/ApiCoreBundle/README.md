# KamiApiCoreBundle

## Installation

```bash
composer require kami/api-core-bundle
```

```php
<?php

// AppKernel.php

    public function registerBundles()
    {
        $bundles = [
            ...
            new Kami\ApiCoreBundle\KamiApiCoreBundle(),
            ...
        ];
    }
```

## Configuration
```yaml
kami_api_core:
  locales: ['en', 'de']
  resources:
    - { name: your-resource-name, entity: AppBundle\Entity\YourEntiy }
```
## Workflow


## Annotations reference

### @Access
Defines roles that can access the resource
```php
<?php

namespace AppBundle\Entity;

class YourEntity
{
    ...
        
    /**
     * @Access({"ROLE_USER", "ROLE_ADMIN"})
     * @ORM\Column(name="property", type="string", length=255)
     */
    private $property;
    
    ...
}
```
### @AnonymousAccess
Defines anonymous access to the resource
### @AnonymousCreate
Defines if anonymous users can create the resource
### @AnonymousEdit