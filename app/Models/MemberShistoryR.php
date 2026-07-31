<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberShistoryR extends Model
{
    protected $connection = 'mariadb::read';

    public $table = 'membershistory';

    public $timestamps = false;
}
