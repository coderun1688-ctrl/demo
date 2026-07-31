<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSteeingR extends Model
{
    protected $connection = 'mariadb::read';

    public $table = 'systemsteeing';

    public $timestamps = false;
}
