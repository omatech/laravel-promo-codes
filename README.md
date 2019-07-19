# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/omatech/laravel-promo-codes.svg?style=flat-square)](https://packagist.org/packages/omatech/laravel-promo-codes)
[![Build Status](https://img.shields.io/travis/omatech/laravel-promo-codes/master.svg?style=flat-square)](https://travis-ci.org/omatech/laravel-promo-codes)
[![Quality Score](https://img.shields.io/scrutinizer/g/omatech/laravel-promo-codes.svg?style=flat-square)](https://scrutinizer-ci.com/g/omatech/laravel-promo-codes)
[![Total Downloads](https://img.shields.io/packagist/dt/omatech/laravel-promo-codes.svg?style=flat-square)](https://packagist.org/packages/omatech/laravel-promo-codes)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require omatech/laravel-promo-codes
```

## Usage

``` php
// Usage description here
```

Generate promotional codes with a prefix:
``` php

$data = [
    'prefix' => 'EXAMPLE',
    ...
];

$promoCode = PromoCode::generate($data);

echo $promoCode->getCode(); //EXAMPLEXXXXX

```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email aroca@omatech.com instead of using the issue tracker.

## Credits

- [Adrià Roca](https://github.com/adriaroca)
- [Agustí Pons](https://github.com/aponscat)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).