<?php
/**
 * Laravel 5 - Persistent Settings
 *
 * @author   Gianluca Di Gesaro gianluca@qwince.com>
 * @license  http://opensource.org/licenses/MIT
 * @package  l5-settings
 */

namespace qwince\LaravelSettings\Traits;

use Illuminate\Support\Facades\Config;
use InvalidArgumentException;
use qwince\LaravelSettings\SettingModel;

trait SettingsUserTrait
{
	/**
     * One-to-Many relations with Setting.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function settings(){
        return $this->hasMany(Config::get('settings.settings_model'));
    }

    public function getSetting(String $key, $default = null){
    	$result = $this->settings()->withKey($key)->first();
        return $result ? $result : $default;
    }

    public function setSetting(String $key, String $value, String $description = null){
    	$setting = SettingModel::firstOrNew(['key' => $key, 'user_id' => $this->id]);
		$setting->value = $value;
		$setting->active = true;
		$setting->description = $description;
		$setting->save();
        return $setting;
    }

    public function forget(String $key){
    	$setting = $this->getSetting($key);
    	if ($setting)
    		$setting->delete();
    }
}