<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\MemberShistoryR;
use App\Models\MemberShistoryW;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;
use App\Plugin\GlobalSettings;

class LoginHistoryController extends Controller
{


    public function __construct(){

    }

    public function index()
    {
        $WebTitle = "登入記錄";


        $managdb = MemberShistoryR::select('*')->where('id',Auth::guard('member')->user()->id)->orderBy('logindate', 'desc')->paginate(10);


        return view('LoginHistory',compact('WebTitle','managdb'));
    }
}
