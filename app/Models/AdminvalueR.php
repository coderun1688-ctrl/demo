<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminvalueR extends Model
{
    protected $connection = 'mariadb::read';

    public $table = 'adminvalue';

    public $timestamps = false;
}
