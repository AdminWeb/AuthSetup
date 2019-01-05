<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 05/01/19
 * Time: 20:39
 */

namespace AuthSetup\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(config('user.model'));
    }
}