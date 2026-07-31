<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminvalueW extends Model
{
    protected $connection = 'mariadb::write';

    public $table = 'adminvalue';

    public $timestamps = false;
}
