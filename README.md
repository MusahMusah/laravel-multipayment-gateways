# A Laravel Package that makes implementation of multiple payment Gateways endpoints and webhooks seamless 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/musahmusah/laravel-multipayment-gateways.svg?style=flat-square)](https://packagist.org/packages/musahmusah/laravel-multipayment-gateways)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/musahmusah/laravel-multipayment-gateways/run-tests?label=tests)](https://github.com/musahmusah/laravel-multipayment-gateways/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/musahmusah/laravel-multipayment-gateways/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/musahmusah/laravel-multipayment-gateways/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/musahmusah/laravel-multipayment-gateways.svg?style=flat-square)](https://packagist.org/packages/musahmusah/laravel-multipayment-gateways)

This package makes it easy to implement multiple payment gateways in your Laravel application. It provides a unified interface for the payment gateways you want to use. It also provides a way to handle webhooks from the payment gateways.

## Installation

You can install the package via composer:

```bash
composer require musahmusah/laravel-multipayment-gateways
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="multipayment-gateways-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="multipayment-gateways-config"
```

[//]: # (This is the contents of the published config file:)

[//]: # ()
[//]: # (```php)

[//]: # (return [)

[//]: # (    )
[//]: # (];)

[//]: # (```)

## Usage

```php

```

## Testing

```bash
php artisan test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [MusahMusah](https://github.com/MusahMusah)
- [Cybernerdie](https://github.com/cybernerdie)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
