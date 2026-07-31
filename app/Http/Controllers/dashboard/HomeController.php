<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends Controller{

    public function __construct(){

    }

    public function dashboard(){
        if (!Auth::guard('admin')->check()) {

            return redirect('/dashboards/login');
        }

        @include(storage_path('app/private/SuperAdmin.php'));

        //$groupid = ['Member'=>1];

        @include(app_path('Plugin/Menu.php'));


        $Menu = [];
        if(!in_array(Auth::guard('admin')->user()->id,$SuperAdminlist)){
            $m = 0;
            foreach ($MenuList as $key => $value){

                foreach ($value['option'] as $k=>$v){
                    if(!$groupid[$k]){
                        unset($value['option'][$k]);
                    } else {
                        $m++;
                    }
                }

                if($m > 0){

                    $Menu[$key]['name'] = $value['name'];
                    $Menu[$key]['ico'] = $value['ico'];
                    $Menu[$key]['option'] = $value['option'];

                }

            }

            //print_r($Menu);exit;
        } else {

            $Menu = $MenuList;
        }


        return view('dashboard.home',compact('Menu','SuperAdminlist'));

    }

}
