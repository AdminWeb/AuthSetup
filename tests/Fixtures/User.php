<?php

namespace AuthSetup\Tests\Fixtures;

use AuthSetup\Traits\Role;
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    use Role;
    protected $fillable = ['name', 'password', 'email'];
}