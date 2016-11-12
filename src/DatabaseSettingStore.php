<?php
/**
 * Laravel 5 - Persistent Settings
 *
 * @author   Gianluca Di Gesaro gianluca@qwince.com>
 * @license  http://opensource.org/licenses/MIT
 * @package  l5-settings
 */
namespace qwince\LaravelSettings;
use Illuminate\Database\Connection;
use InvalidArgumentException;

class DatabaseSettingStore extends SettingStore
{
	/**
	 * Get a specific key from the settings data.
	 *
	 * @param  string|array $key
	 * @param  mixed        $default Optional default value.
	 *
	 * @return mixed
	 */
	public function get($key, $default = null){
		$setting = SettingModel::withKey($key)->first();
		return $setting ? $setting->value : $default;
	}

	/**
	 * Determine if a key exists in the settings data.
	 *
	 * @param  string  $key
	 *
	 * @return boolean
	 */
	public function has($key){
		return SettingModel::withKey($key)->active()->first();
	}

	/**
	 * Set a specific key to a value in the settings data.
	 *
	 * @param string|array $key   Key string or associative array of key => value
	 * @param mixed        $value Optional only if the first argument is an array
	 */
	public function set($key, $value, $description = null){
		$setting = SettingModel::firstOrNew(['key' => $key]);
		$setting->value = $value;
		$setting->active = true;
		$setting->description = $description;
		$setting->save();
	}

	/**
	 * Activate a key in the settings data.
	 *
	 * @param  string $key
	 */
	public function activate($key){
		$setting = SettingModel::withKey($key)->first();
		if ($setting){
			$setting->active = true;
			$setting->save();
		}
		else{
			throw new InvalidArgumentException();
		}
	}

	/**
	 * Deactive a key in the settings data.
	 *
	 * @param  string $key
	 */
	public function deactivate($key){
		$setting = SettingModel::withKey($key)->first();
		if ($setting){
			$setting->active = false;
			$setting->save();
		}
		else{
			throw new InvalidArgumentException();
		}
	}

	/**
	 * Unset a key in the settings data.
	 *
	 * @param  string $key
	 */
	public function forget($key){
		SettingModel::where('key', $key)->delete();
	}

	/**
	 * Unset all keys in the settings data.
	 *
	 * @return void
	 */
	public function forgetAll(){
		SettingModel::delete();
	}

	/**
	 * Get all settings data.
	 *
	 * @return array
	 */
	public function all(){
		$this->data = $this->parseReadData(SettingModel::active()->get());
		return $this->data;
	}

	/**
	 * Parse data coming from the database.
	 *
	 * @param  array $data
	 *
	 * @return array
	 */
	protected function parseReadData($data){
		$results = array();

		foreach ($data as $row) {
			if (is_array($row)) {
				$results[$row['key']] = $row['value'];
			} elseif (is_object($row)) {
				$results[$row->key] = $value = $row->value;
			} else {
				$msg = 'Expected array or object, got '.gettype($row);
				throw new \UnexpectedValueException($msg);
			}

		}


		return $results;
	}
}
