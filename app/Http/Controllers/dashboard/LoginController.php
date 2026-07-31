<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\AdminR;
use App\Models\AdminW;

class LoginController extends Controller{

    public function showLogin(){

        if (Auth::guard('admin')->check()) {
            return redirect('/dashboards');
        }

        return view('dashboard.login');
    }

    public function login(Request $request){

        $input =   $request->all();

        if(empty($input['email'])) {

            return response()->json([
                'status' => false,
                'message' => 'e-mail未輸入'
            ]);


        } else if(empty($input['password'])){

            return response()->json([
                'status' => false,
                'message' => '密碼未輸入'
            ]);
        }


        $r = AdminR::where('email',$input['email'])->first();


        /*
        $r->password = Hash::make($input['password']);
        $r->save();*/





        if(!isset($r->email)){

            return response()->json([
                'status'    =>  false,
                'message' => '帳號不存在'
            ]);

        } else if(!Hash::check($input['password'],$r->password)){
            return response()->json([
                'status'    =>  false,
                'message' => '密碼錯誤'
            ]);
        } else if(!$r->active){
            return response()->json([
                'status'    =>  false,
                'message' => '帳號已停用'
            ]);
        }

        @include(storage_path('app/private/groupid' . $r->groups . '.php'));

        if(isset($AdminGroupid)){
            if (!isset($AdminGroupid['OpenBackend']) || !$AdminGroupid['OpenBackend']) {
                return response()->json([
                    'status'    =>  false,
                    'message' => '您沒有權限訪問登入'
                ]);
            }
        }


        if (Auth::guard('admin')->attempt(['id' =>  (int)$r->id, 'email' => $input['email'], 'password' => $input['password']])) {
            $request->session()->regenerate();
            return response()->json([
                'status'    =>  true,
                'message' => ''
            ]);
        }  else {
            return response()->json([
                'status'    =>  false,
                'message' => '系統登入異常'
            ]);
        }


    }

    public function logout(Request $request){


        Auth::guard('admin')->logout();

        return response()->json([
            'status'    =>  true,
            'message' => ''
        ]);





    }
}