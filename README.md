# IYBA Private Listing API - PHP Library

PLS API - IYBA Private Listing System API

## Installation

Via Composer: Here's what you add to your composer.json file to have `src/API.php` automatically imported into your vendors folder:

    {
        "require": {
            "iyba/pls": "dev-master"
        }
    }

Of course, you'll then need to run `composer update`.  

## How to use

### Instantiate API class

```php
use IYBA\PLS\API;
    
$settings = [
    'key' => 'YOUR API KEY' (String, Required), // Example: 'dcabf94ad97d6f09914c8be1a302891520a5964d'
    'id' => USER ID (Number, Required), // Example: 56
    'endpoint' => 'https://api.iyba.pro' (Optional)
];
    
$api = new API($settings);
```

#### Example

```php
use IYBA\PLS\API;
    
$settings = [
    'key' => 'dcabf94ad97d6f09914c8be1a302891520a5964d',
    'id' => 56,
    'endpoint' => 'https://api.iyba.pro'
];
    
$api = new API($settings);
```

### Filter vessels

Method: `vessel($filters_array)`

```php
$api->vessel([
    'page' => 1,
    'currency' => 'usd',
    'price' => '0,1000000'
]);
```

Optionally `get_filters()` method returns complete query string, hence we can rewrite the above call as
    
```php
$api->vessel($api->get_filters());
```    
    
### Fetch vessel using it's ID and language filter

Method: `vessel(id, $api->get_filters())`

```php
$api->vessel(82, 'lang=fr');
```

### Filter charter vessels

Method: `charter('filter string')`

```php
$api->charter('page=1&currency=usd&price=0,1000000');
$api->charter($api->get_filters()); // As explained above
```
    
### Fetch charter details using vessel ID and language filter

Method: `charter(id, $this->get_filters())`

```php
$api->charter(82, 'lang=fr');
```

### Fetch brokerage details (Yours)

Method: `brokerage()`

```php
$api->brokerage();
```

### Fetch brokerage by it's ID

Method: `brokerage(id)`

```php
$api->brokerage(5);
```

### Vessel and Charter filters

Method: `filters($resource, $filters)`

```php
$api->filters('vessel', 'lang=fr&status=On');
```
