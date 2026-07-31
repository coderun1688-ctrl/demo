<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminR extends Model
{
    protected $connection = 'mariadb::read';
    public $table = 'adminlist';
    public $timestamps = false;
}