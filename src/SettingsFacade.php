<?php
/**
 * Laravel 5 - Persistent Settings
 *
 * @author   Gianluca Di Gesaro <gianlucadigesaro@gmail.com>
 * @license  http://opensource.org/licenses/MIT
 * @package  l5-settings
 */

namespace qwince\LaravelSettings;

class SettingsFacade extends \Illuminate\Support\Facades\Facade
{
	protected static function getFacadeAccessor()
	{
		return 'qwince\LaravelSettings\SettingsManager';
	}
}
