<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermissionR extends Model
{
    protected $connection = 'mariadb::read';

    public $table = 'adminpermission';

    public $timestamps = false;
}
