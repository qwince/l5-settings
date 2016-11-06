<?php
/**
 * Laravel 5 - Persistent Settings
 *
 * @author   Gianluca Di Gesaro gianluca@qwince.com>
 * @license  http://opensource.org/licenses/MIT
 * @package  l5-settings
 */

namespace qwince\LaravelSettings;

use Illuminate\Foundation\Application;

class SettingsServiceProvider extends \Illuminate\Support\ServiceProvider
{
	/**
	 * This provider is deferred and should be lazy loaded.
	 *
	 * @var boolean
	 */
	protected $defer = true;

	/**
	 * Register IoC bindings.
	 */
	public function register()
	{
		$method = version_compare(Application::VERSION, '5.2', '>=') ? 'singleton' : 'bindShared';

		// Bind the manager as a singleton on the container.
		$this->app->$method(SettingsManager::class, function($app) {
			/**
			 * Construct the actual manager.
			 */
			return new SettingsManager($app);
		});

		// Provide a shortcut to the SettingStore for injecting into classes.
		$this->app->bind(SettingStore::class, function($app) {
			return $app->make(SettingsManager::class)->driver();
		});


		$this->mergeConfigFrom(__DIR__ . '/config/config.php', 'settings');
	}

	/**
	 * Boot the package.
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/config/config.php' => config_path('settings.php')
		], 'config');
		$this->publishes([
			__DIR__.'/migrations' => database_path('migrations')
		], 'migrations');
	}

	/**
	 * Which IoC bindings the provider provides.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array(
			'qwince\LaravelSettings\SettingsManager',
			'qwince\LaravelSettings\SettingStore',
		);
	}
}
