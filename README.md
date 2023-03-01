# SuperShip SDK for PHP

<a href="https://packagist.org/packages/supershipvn/supership-sdk-php"><img src="https://img.shields.io/packagist/dt/supershipvn/supership-sdk-php" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/supershipvn/supership-sdk-php"><img src="https://img.shields.io/packagist/v/supershipvn/supership-sdk-php" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/supershipvn/supership-sdk-php"><img src="https://img.shields.io/packagist/l/supershipvn/supership-sdk-php" alt="License"></a>
</p>

## Introduction

Using the **SuperShip SDK for PHP**, developers can easily integrate [SuperShip APIs](https://docs.developers.supership.vn) into their PHP codebase, enabling businesses to automate and scale their shipping operations.

## Features

Some of the SuperShip APIs available include:
* Areas API: This API allows developers to retrieve a list of provinces, districts, and communes supported by SuperShip for the pickup, delivery, and return of goods.
* Auth API: This API allows developers to register a new user and retrieve a token via username and password.
* Orders API: This API allows developers to retrieve shipping rates, create a new order, retrieve order information, obtain order status lists, and generate shipping labels.
* Warehouses API: This API allows developers to create a new warehouse, edit the current warehouse, and retrieve information on all warehouses.
* Webhooks API: This API allows developers to register a new webhook, edit the current webhook, and retrieve registered webhooks.

Please check [SuperShip API Documentation](https://docs.developers.supership.vn) for more details.

## API Documentation

Documentation for SuperShip APIs can be found on the [API Documentation Website](https://docs.developers.supership.vn).

## Installation

You can install the package via composer:

```bash
composer require supershipvn/supership-sdk-php
```

## Usage

### Orders API

#### Create Order

To create a new order, call the `createOrder` method using the following syntax:
    
```php
use SuperShip\SuperShipClient;

$supership = new SuperShipClient('YOUR_API_TOKEN');

$params = [
    'pickup_phone' => '0989999999',
    'pickup_address' => '45 Nguyễn Chí Thanh',
    'pickup_commune' => 'Phường Ngọc Khánh',
    'pickup_district' => 'Quận Ba Đình',
    'pickup_province' => 'Thành phố Hà Nội',
    'name' => 'Trương Thế Ngọc',
    'phone' => '0945900350',
    'email' => null,
    'address' => '35 Trương Định',
    'province' => 'Thành phố Hồ Chí Minh',
    'district' => 'Quận 3',
    'commune' => 'Phường 6',
    'amount' => '220000',
    'value' => null,
    'weight' => '200',
    'payer' => '1',
    'service' => '1',
    'config' => '1',
    'soc' => 'KAN7453535',
    'note' => 'Giao giờ hành chính',
    'product_type' => '2',
    'products' => [
        [
            'sku' => 'P899234',
            'name' => 'Tên Sản Phẩm 1',
            'price' => 200000,
            'weight' => 200,
            'quantity' => 1,
        ],
        [
            'sku' => 'P899789',
            'name' => 'Tên Sản Phẩm 2',
            'price' => 250000,
            'weight' => 300,
            'quantity' => 2,
        ],
    ]
];

$supership->createOrder($params);
```

Optionally, you can retrieve the Order Code using the following method:

```php
$order = $supership->createOrder($params);
echo $order['results']['code'];
```

#### Get Single Order Info

To retrieve single order, call the `getOrderInfo` method using the following syntax:

```php
$supershipOrderCode = 'SUPERSHIP_ORDER_CODE';
$supership->getOrderInfo($supershipOrderCode);
```

#### Get All Order Statuses

To retrieve all order statuses, call the `getOrderStatuses` method using the following syntax:

```php
$supership->getOrderStatuses();
```

#### Create Print Token

To obtain a new token for label printing, call the `createPrintToken` method using the following syntax:

```php
$params = [
    'code' => [
        'SUPERSHIP_ORDER_CODE_1',
        'SUPERSHIP_ORDER_CODE_2'
    ]
];

$supership->createPrintToken($params);
```

#### Get Print Link

To get a print link for print token, call the `getOrderInfo` method using the following syntax:

```php
$printToken = '49ef6620-423e-11e9-b019-b71407a43f47';
$labelSize = 'K46';

$supership->getPrintLink($printToken, $labelSize);
```
### Warehouses API

#### Get All Warehouses

To retrieve all warehouses, call the `getWarehouses` method using the following syntax:

```php
$supership->getWarehouses();
```

#### Create Warehouse

To create a new warehouse, call the `createWarehouse` method using the following syntax:

```php
$params = [
    'name' => 'Kho HBT',
    'phone' => '0989999888',
    'contact' => 'Trần Cao Cường',
    'address' => '47 Lê Lợi',
    'province' => 'Thành phố Hồ Chí Minh',
    'district' => 'Quận Tân Bình',
    'district' => 'Phường 13',
    'primary' => '1'
];

$supership->createWarehouse($params);
```

#### Update Warehouse

To edit the current warehouse, call the `editWarehouse` method using the following syntax:

```php
$params = [
    'code' => 'WLKGT07050',
    'name' => 'Kho Hai Bà Trưng',
    'phone' => '0989999888',
    'contact' => 'Dương Mạnh Quân'
];

$supership->editWarehouse($params);
```

### Webhooks API

#### Get All Webhooks

To retrieve all webhooks, call the `getWebhooks` method using the following syntax:

```php
$supership->getWebhooks();
```

#### Register Webhook

To register a new webhook, call the `registerWebhook` method using the following syntax:

```php
$partnerUrl = 'https://example.com/listen/supership';

$supership->registerWebhook($partnerUrl);
```

### Auth API

#### Create User

To create a new user, call the `createUser` method using the following syntax:

```php
$params = [
    'project' => 'HMN Store',
    'name' => 'Hoàng Mạnh Nam',
    'phone' => '0989998888',
    'email' => 'hmn.store@gmail.com',
    'password' => '323423',
    'partner' => 'lPxLuxfiTotCyZ1ZnQjMepUL24HLd05ybNBhVGFN'
];

$supership->createUser($params);
```

#### Retrieve Token

To retrieve a token via username and password, call the `retrieveToken` method using the following syntax:

```php
$params = [
    'client_id' => 'AZN6QUo40w',
    'client_secret' => 'C4fFVeFPkISEDQ8acNo9oSHUd8yIGuvoLWJdX9zY',
    'username' => 'hmn.store@gmail.com',
    'password' => '323423',
    'partner' => 'lPxLuxfiTotCyZ1ZnQjMepUL24HLd05ybNBhVGFN'
];

$supership->retrieveToken($params);
```

### Areas API

#### Get All Provinces

To retrieve all provinces, call the `getProvinces` method using the following syntax:

```php
$supership->getProvinces();
```

#### Get All Districts

To retrieve all districts, call the `getDistricts` method using the following syntax:

```php
$provinceCode = '79';

$supership->getDistricts($provinceCode);
```

#### Get All Districts

To retrieve all districts, call the `getDistricts` method using the following syntax:

```php
$provinceCode = '79';

$supership->getDistricts($provinceCode);
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information about recent changes.

## Contributing

Thank you for considering contributing to **SuperShip SDK for PHP**! The contribution guide can be found in our [contributing guidelines](CONTRIBUTING.md).

## Security

If you've found a bug regarding security please mail [supertek@supership.vn](mailto:supertek@supership.vn) instead of using the issue tracker.

## Credits

-   [SuperShip](https://github.com/supershipvn)

## License

**SuperShip SDK for PHP** is open-sourced software licensed under the [MIT license](LICENSE).