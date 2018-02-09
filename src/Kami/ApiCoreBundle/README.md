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

### Routing loader
Bundle will generate 4 routes for each resource you specified in your config
* `GET /api/your-resource-name` - Index route
* `GET /api/your-resource-name/{id}` - Get single resource
* `POST /api/your-resource-name` - Create resource
* `PUT /api/your-resource-name/{id}` - Update resource
* `DELETE /api/your-resource-name/{id}` - Delete resource

## Annotations reference

### @Access
Defines roles that can access the resource or property

_Usage example_
```php
<?php

namespace AppBundle\Entity;

use Kami\ApiCoreBundle\Annotation as Api;

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
Defines if anonymous users can edit the resource
_Usage example_

```php
<?php

namespace AppBundle\Entity;

use Kami\ApiCoreBundle\Annotation as Api;

/**
 * @Api\AnonymousEdit
 */
class YourEntity
{
    ...
        
    /**
     * @Api\CanBeCreatedBy({"ROLE_USER", "ROLE_ADMIN"})
     * @ORM\Column(name="property", type="string", length=255)
     */
    private $property;
    
    ...
}
```

### @CanBeCreatedBy
Defines roles that can create the resource or property
_Usage example_

```php
<?php

namespace AppBundle\Entity;

use Kami\ApiCoreBundle\Annotation as Api;

/**
 * @Api\CanBeCreatedBy({"ROLE_USER", "ROLE_ADMIN"})
 */
class YourEntity
{
    ...
        
    /**
     * @Api\CanBeCreatedBy({"ROLE_USER", "ROLE_ADMIN"})
     * @ORM\Column(name="property", type="string", length=255)
     */
    private $property;
    
    ...
}
```
### @CanBeUpdatedBy

Defines roles that can update the resource or property
_Usage example_

```php
<?php

namespace AppBundle\Entity;

use Kami\ApiCoreBundle\Annotation as Api;

/**
 * @Api\CanBeUpdatedBy({"ROLE_USER", "ROLE_ADMIN"})
 */
class YourEntity
{
    ...
        
    /**
     * @Api\CanBeUpdatedBy({"ROLE_USER", "ROLE_ADMIN"})
     * @ORM\Column(name="property", type="string", length=255)
     */
    private $property;
    
    ...
}
```

### @Form

Defines roles that can update the resource or property
_Usage example_

```php
<?php

namespace AppBundle\Entity;

use Kami\ApiCoreBundle\Annotation as Api;

/**
 * @Api\CanBeCreatedBy({"ROLE_USER", "ROLE_ADMIN"})
 */
class YourEntity
{
    ...
        
    /**
     * @Api\Form("Symfony\Component\Form\Extension\Core\Type\TextType", "{"option":"value"}"")
     * @ORM\Column(name="property", type="string", length=255)
     */
    private $property;
    
    ...
}
```