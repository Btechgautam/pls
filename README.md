# MyFYBA Private Listing API - PHP Library

PLS API - MYFYBA Private Listing System API

## Installation

Via Composer: Here's what you add to your composer.json file to have `src/API.php` automatically imported into your vendors folder:

    {
        "require": {
            "myfyba/pls": "dev-master"
        }
    }

Of course, you'll then need to run `composer update`.  

## How to use

#### Note: All methods return serialized JSON

### Instantiate API class

    use MyFYBA\PLS\API;
    
    $settings = [
        'key' => 'YOUR API KEY' (String, Required), // Example: 'dcabf94ad97d6f09914c8be1a302891520a5964d'
        'id' => USER ID (Number, Required), // Example: 56
        'endpoint' => 'https://api.myfyba.org' (Optional)
    ];
    
    $api = new API($settings);

### Filter vessels

Method: `vessel('filter string')`

    $api->vessel('page=1&currency=usd&price=0,1000000');
    
Optionally `get_filters()` method returns complete query string, hence we can rewrite the above call as
    
    $api->vessel($api->get_filters());
    
    
### Fetch vessel using it's ID

Method: `vessel(id)`
    
    $api->vessel(82);
    
### Filter charter vessels

Method: `charter('filter string')`

    $api->charter('page=1&currency=usd&price=0,1000000');
    $api->charter($api->get_filters()); // As explained above
    
    
### Fetch charter details using vessel ID

Method: `charter(id)`
    
    $api->charter(82);


### Fetch brokerage details (Yours)

Method: `brokerage()`

    $api->brokerage();
    
### Fetch brokerage by it's ID

Method: `brokerage(id)`

    $api->brokerage(5);