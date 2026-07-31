<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberShistoryW extends Model
{
    protected $connection = 'mariadb::write';

    public $table = 'membershistory';

    public $timestamps = false;
}
