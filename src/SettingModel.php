<?php
/**
 * Laravel 5 - Persistent Settings
 *
 * @author   Gianluca Di Gesaro <gianlucadigesaro@gmail.com>
 * @license  http://opensource.org/licenses/MIT
 * @package  l5-settings
 */

namespace qwince\LaravelSettings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class SettingModel extends Model
{

    protected $table = 'settings';

    protected $fillable = ['key'];

    public function scopeActive($query){
    	return $query->where('active', 1);
    }

    public function scopeWithKey($query, $key){
    	return $query->where('key', $key);
    }
}