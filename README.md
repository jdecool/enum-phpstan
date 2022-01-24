PHPStan extension for `jdecool/enum`
====================================

[![Build Status](https://github.com/jdecool/enum-phpstan/workflows/CI/badge.svg)](https://github.com/jdecool/enum-phpstan/actions?query=workflow%3ACI)
[![Latest Stable Version](https://poser.pugx.org/jdecool/enum-phpstan/v/stable.png)](https://packagist.org/packages/jdecool/enum-phpstan)


This extension defines dynamic methods for `JDecool\Enum\Enum` subclasses.

## Deprecated

⚠️ This project is no longer actively maintained.

Native enum arrived to PHP in version 8.1: https://www.php.net/enumerations
If your project is running PHP 8.1+ or your library has it as a minimum requirement you should use it instead of this library.

## Usage

To use this extension, require it with [Composer](https://getcomposer.org).

```bash
composer require --dev jdecool/enum-phpstan
```

And include `extension.neon` in your project's PHPStan config

```neon
includes:
  - vendor/jdecool/enum-phpstan/extension.neon
```
