Laravel Elixir Twig Extension
=============================

[![Build Status](https://img.shields.io/travis/stormiix/laravel-mix-twig-extension/master.svg?style=flat-square)](https://travis-ci.org/stormiix/laravel-mix-twig-extension)

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
use BrieucThomas\Twig\Extension\ElixirExtension;

$elixir = new ElixirExtension(
    $publicDir,     // the absolute public directory
    $buildDir,      // the elixir build directory (default value is 'build')
    $manifestName   // the manifest filename (default value is 'rev-manifest.json')
);
$twig->addExtension($elixir);
```

### Register the extension as a Symfony Service

``` yml
# app/config/services.yml
services:
    app.twig_elixir_extension:
        class: BrieucThomas\Twig\Extension\ElixirExtension
        arguments: ["%kernel.root_dir%/../web/"]
        public: false
        tags:
            - { name: twig.extension }
```

### Create a gulpfile

Here an example of `gulpfile.js` to compile and version
the script `app/Resources/js/app.js` :

```javascript
// gulpfile.js
const elixir = require('laravel-elixir');

elixir.config.assetsPath = 'app/Resources';
elixir.config.publicPath = 'web';
elixir.config.appPath = 'src';
elixir.config.viewPath = 'app/Resources/views';

elixir(function(mix) {
    // compile scripts to web/js/all.js (default output)
    mix.scripts(['app.js']);

    // version compiled scripts        
    mix.version(['js/all.js']);
});
```

### Using the Extension

``` twig
<link rel="stylesheet" href="{{ elixir('css/all.css') }}">
<script src="{{ elixir('js/all.js') }}"></script>
```

You can surround with the `asset` twig extension to make your
application more portable:

``` twig
<link rel="stylesheet" href="{{ asset(elixir('css/all.css')) }}">
<script src="{{ asset(elixir('js/all.js')) }}"></script>
```
