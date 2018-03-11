Laravel Elixir Twig Extension
=============================

[![Build Status](https://img.shields.io/travis/Stormiix/laravel-mix-twig-extension/master.svg?style=flat-square)](https://travis-ci.org/Stormiix/laravel-mix-twig-extension)

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

You need PHP >= 7.0 to use the library, but the latest stable version
of PHP is recommended.

## Install

Install using Composer:

``` bash
composer require stormiix/laravel-mix-twig-extension
```

This will edit (or create) your composer.json file and automatically
choose the most recent version.

## Documentation [TODO]

### Register the extension

``` php
use Stormiix\Twig\Extension\MixExtension;

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
<link rel="stylesheet" href="{{ Mix('css/all.css') }}">
<script src="{{ Mix('js/all.js') }}"></script>
```

You can surround with the `asset` twig extension to make your
application more portable:

``` twig
<link rel="stylesheet" href="{{ asset(Mix('css/all.css')) }}">
<script src="{{ asset(Mix('js/all.js')) }}"></script>
```
