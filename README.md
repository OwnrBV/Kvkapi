## KvK API client
This package provide access to the [Kvk API](https://developers.kvk.nl/) using one simple class.

## Installation

Require this package with composer.

```shell
composer require owner/kvkapi
```

Laravel 5.5 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

### Laravel 5.5+:

If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```php
Owner\KvkApi\ServiceProvider::class,
```

### Example

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Owner\KvkApi\Client as KvK;

class CompanyController
{
    public function index(Request $request, KvK $kvk)
    {
        return $kvk->companies()->search($request->query);
    }
}
```
