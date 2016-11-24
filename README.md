# Laravel Settings

Persistent, application-wide settings for Laravel.


## Installation

1. `composer require qwince/l5-settings:dev-master`
2. Add `qwince\LaravelSettings\SettingsServiceProvider::class` to the array of providers in `config/app.php`.
3. Publish config file and migration by running `php artisan vendor:publish -provider="qwince\LaravelSettings\SettingsServiceProvider"`. 
4. Optional: add `'Setting' => qwince\LaravelSettings\SettingsFacade::class` to the array of aliases in `config/app.php`.

## Usage

####Global settings
You can either access the setting store via its facade or inject it by type-hinting towards the abstract class `qwince\LaravelSettings\SettingStore`.

```php
<?php
Setting::set('foo', 'bar');
Setting::get('foo', 'default value');
Setting::forget('foo');
$settings = Setting::all();
?>
```
####User settings
Create a Setting model app/Setting.php using the following example:
```php
<?php namespace App;

use qwince\LaravelSettings\SettingModel;

class Setting extends SettingModel
{
}
```
Next, use the SettingUserTrait trait in your existing User model. For example:
```php
<?php
namespace App;
use qwince\LaravelSettings\Traits\SettingsUserTrait;

class User extends Authenticatable
{
    use SettingsUserTrait;
}

```
This will enable the relation with Setting and add the following methods `settings()`,` hasSetting($key)`, `getSetting($key)`, `setSetting($key, $value, $description)` `activate($key)` and `deactivate($key)`  within your User model.
## Contact

Open an issue on GitHub if you have any problems or suggestions.


## License

The contents of this repository is released under the [MIT license](http://opensource.org/licenses/MIT).
