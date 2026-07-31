<?php

namespace App\Http\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\MemberR;
use App\Models\MemberW;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;
use App\Plugin\GlobalSettings;
use Illuminate\Support\Str;
class ForgotPasswordController extends Controller{


    public function __construct(){

    }

    public function index(){
        $WebTitle = "找回密碼";
        return view('ForgotPassword',compact('WebTitle'));
    }

    public function Update(Request $request){

        $input =   $request->all();

        if(env('RECAPTCHAV3_SITEKEY') && GlobalSettings::getSystemSteeing()['reCAPTCHAV3ForgotPasswordCheck'] == 1){
            $score = RecaptchaV3::verify($input['g-recaptcha-response'], 'ForgotPassword');
            if($score < 0.3){
                    return response()->json([
                        'status' => false,
                        'message' => '系統偵測到非法操作方法'
                    ]);
            }
        }

        if(empty($input['email']) || !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $input['email'])) {
            return response()->json([
                'status' => false,
                'message' => 'E-mail未輸入'
            ]);
        }


        $r = MemberR::where('email',$input['email'])->first();

        if(!isset($r->email) ){
            return response()->json([
                'status'    =>  false,
                'message' => '帳號不存在'
            ]);
        }
        $random = Str::random(6);

        $r->update([
            'password'  =>  Hash::make($random),
        ]);


        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;                      // 0 = off, 1 = client messages, 2 = client and server messages
        $mail->isSMTP();                           // Use SMTP
        $mail->Host       = env('MAIL_HOST');      // SMTP server
        $mail->SMTPAuth   = true;                  // Enable SMTP authentication
        $mail->Username   = env('MAIL_USERNAME');  // SMTP username
        $mail->Password   = env('MAIL_PASSWORD');  // SMTP password
        $mail->SMTPSecure = env('MAIL_ENCRYPTION');// Encryption (tls or ssl)
        $mail->Port       = env('MAIL_PORT');      // TCP port
        $mail->CharSet    = 'UTF-8';
        $mail->setFrom( env('MAIL_FROM_ADDRESS'), GlobalSettings::getSystemSteeing()['WebTitle']);
        $mail->addAddress($input['email'], explode("@",$input['email'])[0]);


        // Content
        $mail->isHTML(true);
        $mail->Subject =  GlobalSettings::getSystemSteeing()['WebTitle'].' 找回密碼';

        $mailBody    =  '親愛的會員您好：<br>';
        $mailBody    .= '這是您的帳號臨時登入密碼：<br><br>';
        $mailBody    .=  $random.'<br><br>';
        $mailBody    .= '請盡速登入帳號修改密碼，防止被不法人士盜用帳號。<br>';
        $mailBody    .= '如有任何問題，歡迎與我們聯繫。<br>';
        $mailBody    .= '謝謝！';

        $mail->Body    = $mailBody;

        $mail->send();


        return response()->json([
            'status'    =>  true,
            'message' => ''
        ]);
    }

}
