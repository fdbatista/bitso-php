# bitso-php #

A php wrapper for the [Bitso API](https://bitso.com/api_info/) 


# Public API Usage #

```php
require('bitso.php');
$bitso = new bitso();
```

# Private API Usage #
```php
require('bitso.php');
$bitso = new bitso(API_KEY, API_SECRET);
```

# Public Calls #

### Available Books ###

```php
## Order bookds available on Bitso
$books = bitso->available_books();
```

