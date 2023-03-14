# Laravel URI Translator

[![GitHub release](https://img.shields.io/github/release/codezero-be/laravel-uri-translator.svg?style=flat-square)](https://github.com/codezero-be/laravel-uri-translator/releases)
[![Laravel](https://img.shields.io/badge/laravel-10-red?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![License](https://img.shields.io/packagist/l/codezero/laravel-uri-translator.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/github/actions/workflow/status/codezero-be/laravel-uri-translator/run-tests.yml?style=flat-square&logo=github&logoColor=white&label=tests)](https://github.com/codezero-be/laravel-uri-translator/actions)
[![Code Coverage](https://img.shields.io/codacy/coverage/ad6fcea152b449d380a187a375d0f7d7/master?style=flat-square)](https://app.codacy.com/gh/codezero-be/laravel-uri-translator)
[![Code Quality](https://img.shields.io/codacy/grade/ad6fcea152b449d380a187a375d0f7d7/master?style=flat-square)](https://app.codacy.com/gh/codezero-be/laravel-uri-translator)
[![Total Downloads](https://img.shields.io/packagist/dt/codezero/laravel-uri-translator.svg?style=flat-square)](https://packagist.org/packages/codezero/laravel-uri-translator)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/R6R3UQ8V)

This package registers a macro for the Laravel `Translator` class.
This will allow you to translate individual URI slugs, while ignoring parameter placeholders.

Parameters will not be translated by this macro. That remains the responsibility of your code.

## ✅ Requirements

- PHP >= 7.2.5
- Laravel >= 7.0

## 📦 Install

Install this package with Composer:

```bash
composer require codezero/laravel-uri-translator
```

Laravel will automatically register the ServiceProvider.

In your app's `lang` folder, create subdirectories for every locale you want to have translations for.

Next create a `routes.php` file in each of those directories.

```
lang/
  ├── en/
  │    └── routes.php
  └── nl/
       └── routes.php
```

Return an array of translations from the `routes.php` files.

### 🚀 Usage

Use the `Lang::uri()` macro when registering routes:

```php
Route::get(Lang::uri('hello/world'), [Controller::class, 'index']);
```

The URI macro accepts 2 additional parameters:

1. A locale, in case you need translations to a locale other than the current app locale.
2. A namespace, in case your translation files reside in a package.

```php
Lang::uri('hello/world', 'fr', 'my-package');
```

You can also use `trans()->uri('hello/world')` instead of `Lang::uri('hello/world')`.

### 🔌 Example

Using these example translations:

```php
// lang/nl/routes.php
return [
    'hello' => 'hallo',
    'world' => 'wereld',
    'override/hello/world' => 'something/very/different',
    'hello/world/{parameter}' => 'uri/with/{parameter}',
];
```

These are possible translation results:

```php
// Translate every slug individually
// Translates to: 'hallo/wereld'
Lang::uri('hello/world');

// Keep original slug when missing translation
// Translates to: 'hallo/big/wereld'
Lang::uri('hello/big/world');

// Translate slugs, but not parameter placeholders
// Translates to: 'hallo/{world}'
Lang::uri('hello/{world}');

// Translate full URIs if an exact translation exists
// Translates to: 'something/very/different'
Lang::uri('override/hello/world');

// Translate full URIs if an exact translation exists (with placeholder)
// Translates to: 'uri/with/{parameter}'
Lang::uri('hello/world/{parameter}');
```

## 🚧 Testing

```bash
composer test
```
## ☕️ Credits

- [Ivan Vermeyen](https://github.com/ivanvermeyen)
- [All contributors](https://github.com/codezero-be/laravel-uri-translator/contributors)

## 🔒 Security

If you discover any security related issues, please [e-mail me](mailto:ivan@codezero.be) instead of using the issue tracker.

## 📑 Changelog

A complete list of all notable changes to this package can be found on the
[releases page](https://github.com/codezero-be/laravel-uri-translator/releases).

## 📜 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
