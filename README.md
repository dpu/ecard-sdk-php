# dlpu-ecard

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

dlpu-ecard 大连工业大学校园卡

## Install

Via Composer

``` bash
$ composer require xu42/dlpu-ecard
```

## Usage

``` php
require_once './vendor/autoload.php';
$userOutid = '1305040301';
$dlpuEcard = new \Xu42\DlpuEcard\DlpuEcard($userOutid);
$result = $dlpuEcard->get();
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

Tests unavailable.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please using the issue tracker.

## Credits

- [Xu42](https://github.com/xu42)
- [All Contributors](https://github.com/xu42/dlpu-ecard/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/xu42/dlpu-ecard.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/xu42/dlpu-ecard.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/xu42/dlpu-ecard
[link-downloads]: https://packagist.org/packages/xu42/dlpu-ecard
[link-author]: https://github.com/xu42
[link-contributors]: ../../contributors
