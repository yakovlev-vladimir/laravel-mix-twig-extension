Laravel-Mix Twig Extension
=============================

[![GitHub stars](https://img.shields.io/github/stars/Stormiix/laravel-mix-twig-extension.svg)](https://github.com/Stormiix/laravel-mix-twig-extension/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/Stormiix/laravel-mix-twig-extension.svg?style=flat)](https://github.com/Stormiix/laravel-mix-twig-extension/network)
[![Build Status](https://img.shields.io/travis/Stormiix/laravel-mix-twig-extension/master.svg?style=flat-square)](https://travis-ci.org/Stormiix/laravel-mix-twig-extension)
[![Donations Badge](https://stormix.co/donate/images/badge.svg)](https://stormix.co/donate/)

The Laravel mix `version` task appends a unique hash to filename,
allowing for cache-busting.
For example, the generated file name will look something like:
`all-16d570a7.css`.

In Laravel, you can use in your views the `mix()` function to load
the appropriately hashed asset:

``` html
<link rel="stylesheet" href="{{ mix("css/all.css") }}">
```

This twig extension is an adaptation of this `mix()` function.

## Requirements

You need PHP >= 8.0 to use the library, but the latest stable version
of PHP is recommended.

## Install

Install using Composer:

``` bash
composer require yakovlev-vladimir/laravel-mix-twig-extension:dev-master
```

This will edit (or create) your composer.json file and automatically
choose the most recent version.

## Documentation [TODO]

### Register the extension

``` php
use Yakovlev\Twig\Extension\MixExtension;

$mix = new MixExtension(
    $publicDir,     // the absolute public directory
    $manifestName   // the manifest filename (default value is 'mix-manifest.json')
);
$twig->addExtension($mix);
```

### Register the extension as a Symfony Service

Refer to the original repo.

### Using the Extension

``` twig
<link rel="stylesheet" href="{{ mix('css/all.css') }}">
<script src="{{ mix('js/all.js') }}"></script>
```

You can surround with the `asset` twig extension to make your
application more portable:

``` twig
<link rel="stylesheet" href="{{ asset(Mix('css/all.css')) }}">
<script src="{{ asset(Mix('js/all.js')) }}"></script>
```

## Authors

* **Brieuc Thomas** - *Initial work* - [Elixir-twig-extension](https://github.com/brieucthomas/elixir-twig-extension)

* **Anas Mazouni** - [laravel-mix-twig-extension](https://github.com/Stormiix/laravel-mix-twig-extension)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
