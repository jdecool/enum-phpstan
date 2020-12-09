PHPStan extension for `jdecool/enum`
====================================

This extension defines dynamic methods for `JDecool\Enum\Enum` subclasses.

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
