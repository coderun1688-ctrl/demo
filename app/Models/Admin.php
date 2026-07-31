<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable{

    use Notifiable;
    //protected $connection = 'mariadb::readwrite';
    protected $table = 'adminlist';
    public $timestamps = false;

    protected $fillable = ['id','username','email', 'password'];
    protected $hidden = ['password', 'remember_token'];
}