<?php
/**
 * Laravel 5 - Persistent Settings
 *
 * @author   Gianluca Di Gesaro gianluca@qwince.com>
 * @license  http://opensource.org/licenses/MIT
 * @package  l5-settings
 */

namespace qwince\LaravelSettings;

use Illuminate\Support\Manager;
use Illuminate\Foundation\Application;

class SettingsManager extends Manager
{
	public function getDefaultDriver()
	{
		return 'database';
	}

	public function createDatabaseDriver()
	{
		$connectionName = $this->getConfig('connection');
		$connection = $this->app['db']->connection($connectionName);
		$table = $this->getConfig('table');

		return new DatabaseSettingStore($connection, $table);
	}

	protected function getConfig($key)
	{
		return $this->app['config']->get('settings.'.$key);
	}
}
