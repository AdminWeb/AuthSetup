<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 05/01/19
 * Time: 20:43
 */

namespace AuthSetup\Traits;


trait Role
{
    public function role()
    {
        return $this->belongsTo(\AuthSetup\Models\Role::class);
    }
}