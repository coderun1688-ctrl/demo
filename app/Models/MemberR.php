<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberR extends Model{
    protected $connection = 'mariadb::read';

    public $table = 'membersdata';

    public $timestamps = false;
}
