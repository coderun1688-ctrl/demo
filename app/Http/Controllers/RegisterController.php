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
use Illuminate\Support\Facades\Crypt;

class RegisterController extends Controller{

    public function __construct(){

    }

    public function index(){
        $WebTitle = "註冊";
        return view('Register',compact('WebTitle'));
    }


    public function Update(Request $request){

        $input =   $request->all();

        if(env('RECAPTCHAV3_SITEKEY') && GlobalSettings::getSystemSteeing()['reCAPTCHAV3regCheck'] == 1){
            $score = RecaptchaV3::verify($input['g-recaptcha-response'], 'Register');
            if($score < 0.3){
                return response()->json([
                    'status' => false,
                    'message' => '系統偵測到非法操作方法'
                ]);
            }
        }
        if(!isset($input['email']) || !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $input['email'])){
            return response()->json([
                'status'    =>  false,
                'message' => '請輸入正確E-mail格式'
            ]);
        }

        if(!isset($input['password']) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/', $input['password']) ){
            return response()->json([
                'status'    =>  false,
                'message' => '請輸入正確密碼格式，包含 1 個大小寫英文字母、1 個數字、密碼長度至少 6 碼開始以上'
            ]);
        }

        if(!isset($input['TermsUse']) || !$input['TermsUse']){
            return response()->json([
                'status'    =>  false,
                'message' => '請選擇遵守會員使用條款'
            ]);
        }

        if (MemberR::where('email', $input['email'])->exists()) {
            return response()->json([
                'status'    =>  false,
                'message' => '該E-mail已註冊過'
            ]);
        }

        $timestamp = time();
        $id = 0;
        if(env('MAIL_USERNAME') && GlobalSettings::getSystemSteeing()['EmailCheck'] == 1) {


                $id = MemberW::insertGetId([
                    'username'  =>  explode("@",$input['email'])[0],
                    'email'     =>  $input['email'],
                    'password'  =>  Hash::make($input['password']),
                    'opass'     =>  Crypt::encryptString($input['password']),
                    'logindate' =>  $timestamp,
                    'registerdate'  =>  $timestamp,
                    'active'        =>  1,
                ]);

                $random = Str::random();
                $request->session()->put('random', $random);
                $request->session()->put('id', $id);
                $request->session()->put('email', $input['email']);
                $request->session()->put('password', $input['password']);

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
                $mail->Subject =  GlobalSettings::getSystemSteeing()['WebTitle'].' 請完成您的會員註冊驗證';

                $mailBody    =  '親愛的會員您好：<br>';
                $mailBody    .= '感謝您註冊【'.GlobalSettings::getSystemSteeing()['WebTitle'].'】會員！<br>';
                $mailBody    .= '為了確保您的電子郵件地址正確無誤，並完成帳號啟用，請點擊下方驗證連結：<br><br>';
                $mailBody    .= '【驗證連結】<br>';
                $mailBody    .= '若您無法直接點擊，請將以下網址複製到瀏覽器開啟：<br>';
                $mailBody    .= '<a href="'.$request->host().'/Login/Verificationlink/'.$random.'">【驗證網址】</a><br><br>';
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


                /*
                // Storing data
                $request->session()->put('key', 'value');

                // Retrieving data (returns 'default' if the key doesn't exist)
                $value = $request->session()->get('key', 'default');

                // Checking if an item exists and is not null
                if ($request->session()->has('key')) { }

                // Deleting a specific item
                $request->session()->forget('key');
                 */


                return response()->json([
                    'status'    =>  'Verification',
                    'message' => '驗證信已經發信到您 E-mail 信箱'
                ]);

        } else {

            $id = MemberW::insertGetId([
                'username'  =>  explode("@",$input['email'])[0],
                'email'     =>  $input['email'],
                'password'  =>  Hash::make($input['password']),
                'opass'     =>  Crypt::encryptString($input['password']),
                'logindate' =>  $timestamp,
                'registerdate'  =>  $timestamp,
                'active'        =>  1,
            ]);

            if (Auth::guard('member')->attempt(['id' =>  (int)$id, 'email' => $input['email'], 'password' => $input['password']])) {
                $request->session()->regenerate();
            }

            return response()->json([
                'status'    =>  true,
                'message' => ''
            ]);
        }

        return response()->json([
            'status'    =>  false,
            'message' => 'Error'
        ]);

    }

}
