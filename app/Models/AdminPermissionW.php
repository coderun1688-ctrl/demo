<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermissionW extends Model
{
    protected $connection = 'mariadb::write';

    public $table = 'adminpermission';

    public $timestamps = false;
}
