<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberW extends Model{
    protected $connection = 'mariadb::write';

    public $table = 'membersdata';

    public $timestamps = false;
}
