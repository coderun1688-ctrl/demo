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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use App\Plugin\GlobalSettings;

class PersonalCenterController extends Controller{

    public function __construct(){

    }

    public function index(){

        $WebTitle = "個人中心";

        $member = MemberR::where('id',Auth::guard('member')->user()->id)->first();

        return view('PersonalCenter',compact('WebTitle','member'));

    }

    public function UpdateName(Request $request){
        $input =   $request->all();

        if(!isset($input['username'])){
            return response()->json([
                'status'    =>  false,
                'message' => '不存在匿名名稱'
            ]);
        }

        $input['username'] = preg_replace('/<[^>]+>/', '', $input['username']);

        $member = MemberR::where('id',Auth::guard('member')->user()->id)->first();

        $timestamp = time();

        if(isset($member->namemodifydate) && $member->namemodifydate && $timestamp-$member->namemodifydate < (30 * 86400)){
            return response()->json([
                'status'    =>  false,
                'message' => '拒離您上一次修改未超過 30 天，禁止修改匿名名稱。'
            ]);
        }

        if (!preg_match('/^[^<>!@#$%^&*()+=\[\]{};:\'"\\|,.<>\/?]+$/', $input['username'])) {
            return response()->json([
                'status'    =>  false,
                'message' => '修改匿名名稱不能包含非法字元？'
            ]);
        }



        MemberW::where('id',Auth::guard('member')->user()->id)->update([
            'username'  =>  $input['username'],
            'namemodifydate'    =>  $timestamp
        ]);


        return response()->json([
            'status'    =>  true,
            'message' => ''
        ]);
    }


    public function Updateemail(Request $request)
    {


        $input =   $request->all();

        if(!isset($input['email'])){
            return response()->json([
                'status'    =>  false,
                'message' => '不存在E-mail'
            ]);
        }


        $input['email'] = preg_replace('/<[^>]+>/', '', $input['email']);

        $member = MemberR::where('id',Auth::guard('member')->user()->id)->first();

        $timestamp = time();

        if(isset($member->emailmodifydate) && $member->emailmodifydate && $timestamp-$member->emailmodifydate < (6 * 86400)){
            return response()->json([
                'status'    =>  false,
                'message' => '拒離您上一次修改未超過 6 天，禁止修改E-mail。'
            ]);
        }

        if($member->email != $input['email']){
            return response()->json([
                'status'    =>  false,
                'message' => '不存在E-mail'
            ]);
        }


        MemberW::where('id',Auth::guard('member')->user()->id)->update([
            'email'  => $input['email'],
            'email_verified_at' =>  0
        ]);


        if(env('MAIL_USERNAME')) {

            $random = Str::random();
            $request->session()->put('random', $random);
            $request->session()->put('id', $member->id);
            $request->session()->put('email', $input['email']);
            $request->session()->put('password', Crypt::decryptString($member->opass));



            $mail = new PHPMailer(true);
            $mail->SMTPKeepAlive = false;
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
            $mail->setLanguage('zh', base_path('vendor/phpmailer/phpmailer/language/'));

            // Content
            $mail->isHTML(true);
            $mail->Subject =  GlobalSettings::getSystemSteeing()['WebTitle'].' 您更改 E-mail 請重新驗證';

            $mailBody    =  '親愛的會員您好：<br>';
            $mailBody    .= '您已經更改E-mail！<br>';
            $mailBody    .= '為了確保您的電子郵件地址正確無誤，並完成帳號啟用，請點擊下方驗證連結：<br><br>';
            $mailBody    .= '【驗證連結】<br>';
            $mailBody    .= '若您無法直接點擊，請將以下網址複製到瀏覽器開啟：<br>';
            $mailBody    .= '<a href="'.$request->host().'/PersonalCenter/Verificationlink/'.$random.'">【驗證網址】</a><br><br>';
            $mailBody    .= '※ 此驗證連結將於 24 小時內失效，逾時請重新申請驗證信。<br>';
            $mailBody    .= '如果這不是您本人申請的帳號，請忽略此封郵件，您的帳號將不會完成啟用。<br>';
            $mailBody    .= '如有任何問題，歡迎與我們聯繫。<br>';
            $mailBody    .= '謝謝！';
            $mail->Body    = $mailBody;

            if (!$mail->send()) {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  $mail->ErrorInfo
                ]);
                return  false;
            }


            return response()->json([
                'status'    =>  true,
                'message' => ''
            ]);


        } else {

            return response()->json([
                'status'    =>  false,
                'message' => 'E-mail無法送出驗證'
            ]);
        }


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

}
