<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSuperW extends Model
{
    protected $connection = 'mariadb::write';

    public $table = 'adminsuper';

    public $timestamps = false;
}