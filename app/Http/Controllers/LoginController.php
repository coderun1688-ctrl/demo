<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\MemberR;
use App\Models\MemberW;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;
use App\Plugin\GlobalSettings;

class LoginController extends Controller{

    public function __construct(){

    }

    public function index(){
        $WebTitle = "登入";

        return view('Login',compact('WebTitle'));
    }

    public function Verificationlink($VerificationCode,Request $request){
            $WebTitle = "驗證";

            if($request->session()->missing('random') || $request->session()->get('random') != $VerificationCode){

                return view('VerificationError',compact('WebTitle'));

            } else {
                $timestamp = time();
                MemberW::where('id',$request->session()->get('id'))->update([
                    'email_verified_at'  =>  $timestamp,
                    'emailmodifydate'    =>  $timestamp
                ]);

                if (Auth::guard('member')->attempt(['id' =>  (int)$request->session()->get('id'), 'email' => $request->session()->get('email'), 'password' =>$request->session()->get('password')])) {
                    $request->session()->regenerate();
                }

                $request->session()->forget('random');
                $request->session()->forget('id');

                $request->session()->forget('email');
                $request->session()->forget('password');

                return view('VerificationSuccess',compact('WebTitle'));

            }
    }


    public function Update(Request $request){
        $input =   $request->all();



        if(env('RECAPTCHAV3_SITEKEY') && GlobalSettings::getSystemSteeing()['reCAPTCHAV3loginCheck'] == 1){
            $score = RecaptchaV3::verify($input['g-recaptcha-response'], 'Login');
            if($score < 0.3){
                return response()->json([
                    'status' => false,
                    'message' => '系統偵測到非法操作方法'
                ]);
            }
        }



        if(empty($input['email'])) {
            return response()->json([
                'status' => false,
                'message' => 'E-mail未輸入'
            ]);
        } else if(empty($input['password'])){
            return response()->json([
                'status' => false,
                'message' => '密碼未輸入'
            ]);
        }

        $r = MemberR::where('email',$input['email'])->first();

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
        } else if(!$r->active) {

            return response()->json([
                'status' => false,
                'message' => '帳號已停用'
            ]);

        } else if(GlobalSettings::getSystemSteeing()['EmailCheck'] == 1 && !$r->email_verified_at) {

            return response()->json([
                'status' => false,
                'message' => '您的 E-mail 未驗證'
            ]);
        }

        if (Auth::guard('member')->attempt(['id' =>  (int)$r->id, 'email' => $input['email'], 'password' => $input['password']])) {
            $request->session()->regenerate();
        }


        return response()->json([
            'status'    =>  true,
            'message' => ''
        ]);
    }


    public function logout(Request $request){


        Auth::guard('member')->logout();

        return response()->json([
            'status'    =>  true,
            'message' => ''
        ]);

    }

}
