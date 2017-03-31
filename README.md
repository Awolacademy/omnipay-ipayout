# Omnipay: iPayout

**iPayout for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Total Apps Gateway support for Omnipay.

## Install

Via Composer

``` bash
$ composer require awolacademy/omnipay-ipayout
```

## Usage

The following gateways are provided by this package:

 * iPayout

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay) repository.

This driver supports following transaction types:

[TODO: List transaction types]

Gateway instantiation:
``` PHP
    $gateway = Omnipay::create('iPayout');
    $gateway->setProcessorId('abcdefg1234567');
    $gateway->setToken('6ef44f261a4a1595cd377d3ca7b57b92');
    $gateway->setTestMode(true);
```

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/awolacademy/omnipay-ipayout/issues),
or better yet, fork the library and submit a pull request.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email jablonski.kce@gmail.com instead of using the issue tracker.

## Credits

- [John Jablonski](https://github.com/jan-j)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
