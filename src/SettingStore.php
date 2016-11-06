<?php
/**
 * Laravel 5 - Persistent Settings
 *
 * @author   Gianluca Di Gesaro <gianlucadigesaro@gmail.com>
 * @license  http://opensource.org/licenses/MIT
 * @package  l5-settings
 */

namespace qwince\LaravelSettings;

use qwince\LaravelSettings\SettingModel;
abstract class SettingStore
{
	/**
	 * The settings data.
	 *
	 * @var array
	 */
	protected $data = [];


}
