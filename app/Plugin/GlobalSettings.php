<?php

namespace App\Plugin;

class GlobalSettings{

    public static function getSystemSteeing(){

            @include(storage_path('app/private/SystemSteeing.php'));

            return $SystemSteeing;

    }
}