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
## Order books available on Bitso
$books = bitso->available_books();
```

### Ticker ###

```php
## Ticker information
## Parameters
## [book] - Specifies which book to use
##                  - string
$ticker = bitso->ticker(["book"=>"btc_mxn"]);
 ```

### Order Book ###

```php
## Public order book
## Parameters
## [book] - Specifies which book to use
##                  - string
## [aggregate = True] - Group orders with the same price
##                - boolean

$ob = bitso->order_book(["book"=>"btc_mxn","aggregate"=> "True"]);
```

### Trades ###

```php
## Public trades
## Parameters
## [book = 'btc_mxn'] - Specifies which book to use
##                    - str
## [marker = None] - Returns objects that are older or newer (depending on 'sort’) than the object with this ID
##                    - str
## [sort = 'desc'] - Specifies ordering direction of returned objects (asc, desc)
##                    - str
## [limit = '25'] - Specifies number of objects to return. (Max is 100)
##                    - str

$trades = bitso->trades(["book"=>"btc_mxn"]);


```


# Private calls #

Private endpoints are used to manage your account and your orders. These requests must be signed
with your [Bitso credentials](https://bitso.com/api_info#generating-api-keys) 


### Account Status ###

```php
## Your account status
$status = $bitso->account_status();

```



### Account Balances ###

```php
## Your account balances
$balances = $bitso->account_balance();

```

### Fees ###

```php
## Your trade fees
$fees = $bitso->fees();

```

### Ledger ###
```php
## A ledger of your historic operations.
## Parameters
## [marker]    - Returns objects that are older or newer (depending on 'sort’) than the object with this ID
##                 - string
## [limit = 25]   - Limit result to that many transactions
##                 - int
## [sort = 'desc'] - Sorting by datetime
##                 - string - 'asc' or
##                 - 'desc'

$ledger = $bitso->ledger(["limit"=>"15"]);
```

### Withdrawals ###

```php
## Detailed info on your fund withdrawals.
## Parameters
## [wids]    - Specifies which withdrawal objects to return by IDs
##                 - list
## [marker]    - Returns objects that are older or newer (depending on 'sort’) than the object with this ID
##                 - string
## [limit = 25]   - Limit result to that many transactions
##                 - int
## [sort = 'desc'] - Sorting by datetime
##                 - string - 'asc' or
##                 - 'desc'

$withdrawals = $bitso->withdrawals(["limit"=>"20"],(wids));
```

### Fundings ###

```php
## Detailed info on your fundings.
## Parameters
## [fids]    - Specifies which funding objects to return by IDs
##                 - list
## [marker]    - Returns objects that are older or newer (depending on 'sort’) than the object with this ID
##                 - string
## [limit = 25]   - Limit result to that many transactions
##                 - int
## [sort = 'desc'] - Sorting by datetime
##                 - string - 'asc' or
##                 - 'desc'

$fundings = $bitso->fundings(["limit"=>"20"],(fids));
```




### User Trades ###

```php
## Your trades
## Parameters
## [book = all]- Specifies which book to use
##                 - string
## [marker]    - Returns objects that are older or newer (depending on 'sort’) than the object with this ID
##                 - string
## [limit = 25]   - Limit result to that many transactions
##                 - int
## [sort = 'desc'] - Sorting by datetime
##                 - string - 'asc' or
##                 - 'desc'

$user_trades = $bitso->user_trades(['book'=>'btc_mxn']);


```

### Open Orders ###

```php
## Returns a list of the user’s open orders
## Parameters
## [book] - Specifies which book to use
##                    - str
## [marker]    - Returns objects that are older or newer (depending on 'sort’) than the object with this ID
##                 - string
## [limit = 25]   - Limit result to that many transactions
##                 - int
## [sort = 'desc'] - Sorting by datetime
##                 - string - 'asc' or
##                 - 'desc'
$open_orders = $bitso->open_orders(['book'=>'btc_mxn']);
```

### Lookup Order ###

```php
## Returns a list of details for 1 or more orders
## Parameters
## order_ids -  A list of Bitso Order IDs.
##          - string
$lookup_order = $bitso->lookup_order([oids]);
```

### Cancel Order ###

```php
## Cancels an open order
## Parameters
## order_id -  A Bitso Order ID.
##          - string
$cancel_order =  $bitso->cancel_order([oids]);
```

### Place Order ###

```php
## Places a buy limit order.
## [book] - Specifies which book to use (btc_mxn, eth_mxn)
##                    - str
## [side] - the order side (buy, sell) 
##                    - str
## [order_type] - the order type (limit, market) 
##                    - str
## amount - Amount of major currency to buy.
##        - string
## major  - The amount of major currency for this order. An order must be specified in terms of major or minor, never both.
##        - string. Major denotes the cryptocurrency, in our case Bitcoin (BTC) or Ether (ETH).
## minor  - The amount of minor currency for this order. Minor denotes fiat currencies, in our case Mexican Peso (MXN)
##        - string
## price  - Price per unit of major. For use only with limit orders
##        - string

$place_order = $bitso->place_order(['book'  => 'btc_mxn', 'side'  => 'buy', 'major' => '.01', 'price' => '1000', type'  => 'limit']);
```


### Funding Destination Address ###

```php
## Gets a Funding destination address to fund your account
## fund_currency  - Specifies the currency you want to fund your account with (btc, eth, mxn)
##                            - str
$funding_destination = $bitso->funding_destination(['fund_currency'=>'eth']);
```


### Bitcoin Withdrawal ###

```php
## Triggers a bitcoin withdrawal from your account
## amount  - The amount of BTC to withdraw from your account
##         - string
## address - The Bitcoin address to send the amount to
##         - string

$btc_withdrawal = $bitso->btc_withdrawal(['amount'=>'.05','address'  => '']);
```

### Ether Withdrawal ###

```php
## Triggers a bitcoin withdrawal from your account
## amount  - The amount of BTC to withdraw from your account
##         - string
## address - The Bitcoin address to send the amount to
##         - string

$eth_withdrawal = $bitso->eth_withdrawal(['amount'  => '.05','address'  => '']);

```



### Ripple Withdrawal ###

```php
## Triggers a ripple withdrawal from your account
## currency  - The currency to withdraw
##         - string
## amount  - The amount of BTC to withdraw from your account
##         - string
## address - The ripple address to send the amount to
##         - string

$ripple_withdrawal = $bitso->ripple_withdrawal(['currency'=>'MXN','amount'=> '.05','address'  => '']);

```



### Bank Withdrawal (SPEI) ###

```php
## Triggers a SPEI withdrawal from your account. These withdrawals are
##   immediate during banking hours (M-F 9:00AM - 5:00PM Mexico City Time).
##
## amount  - The amount of MXN to withdraw from your account
##         - string
## recipient_given_names - The recipient’s first and middle name(s)
##         - string
## recipient_family_names - The recipient’s last name)
##         - string
## clabe - The CLABE number where the funds will be sent to
##         - string
## notes_ref - The alpha-numeric reference number for this SPEI
##         - string
## numeric_ref - The numeric reference for this SPEI
##         - string

$spei_withdrawal = $bitso->spei_withdrawal(['amount'  => '105','recipient_given_names'  => 'Andre Pierre','recipient_family_names'=>'Gignac', 'clabe'=>'CLABE','notes_ref'=>'NOTES_REF','numeric_ref'=>'NUMERIC REF']);
```
