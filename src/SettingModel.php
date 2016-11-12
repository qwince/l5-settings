<?php
/**
 * Laravel 5 - Persistent Settings
 *
 * @author   Gianluca Di Gesaro gianluca@qwince.com>
 * @license  http://opensource.org/licenses/MIT
 * @package  l5-settings
 */

namespace qwince\LaravelSettings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class SettingModel extends Model
{
	public function __construct(array $attributes = array()) {
	    parent::__construct($attributes);
	    $this->table = Config::get("settings.table");
	}


    //protected $table = Config::get("settings.table");

    protected $fillable = ['key', 'user_id'];

    public function scopeActive($query){
    	return $query->where('active', 1);
    }

    public function scopeWithKey($query, $key){
    	return $query->where('key', $key);
    }
}