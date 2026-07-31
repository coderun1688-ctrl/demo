<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSteeingW extends Model
{
    protected $connection = 'mariadb::write';

    public $table = 'systemsteeing';

    public $timestamps = false;
}
