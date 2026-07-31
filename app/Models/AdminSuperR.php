<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSuperR extends Model
{
    protected $connection = 'mariadb::read';

    public $table = 'adminsuper';

    public $timestamps = false;
}