<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminW extends Model
{
    protected $connection = 'mariadb::write';
    public $table = 'adminlist';
    public $timestamps = false;
}