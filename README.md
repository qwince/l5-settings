# Laravel Settings

Persistent, application-wide settings for Laravel.


## Installation

1. `composer require qwince/l5-settings`
2. Add `qwince\LaravelSettings\ServiceProvider` to the array of providers in `config/app.php`.
3. Publish config file and migration by running `php artisan vendor:publish`. 
4. Optional: add `'Setting' => 'qwince\LaravelSettings\Facade'` to the array of aliases in `config/app.php`.

## Usage

You can either access the setting store via its facade or inject it by type-hinting towards the abstract class `qwince\LaravelSettings\SettingStore`.

```php
<?php
Setting::set('foo', 'bar');
Setting::get('foo', 'default value');
Setting::get('nested.element');
Setting::forget('foo');
$settings = Setting::all();
?>
```

## Contact

Open an issue on GitHub if you have any problems or suggestions.


## License

The contents of this repository is released under the [MIT license](http://opensource.org/licenses/MIT).
