<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\MemberR;
use App\Models\MemberW;
use App\Models\MemberShistoryR;
use App\Models\MemberShistoryW;
use App\Plugin\GlobalSettings;
use GeoIp2\Database\Reader;

class GlobalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::guard('member')->check()) {
            $ipAddress = $request->ip();
            // 今日開始時間
            $today_start = strtotime('today');
            $timestamp = time();



            $r = MemberR::select('logindate','active')->where('id',Auth::guard('member')->user()->id)->first();
            if(!$r->active) {

                Auth::guard('member')->logout();

                return redirect('/Login');

            } else if($r->logindate < $today_start) {

                MemberW::where('id', Auth::guard('member')->user()->id)->update([
                    'logindate' => $timestamp,
                ]);

            } else if($timestamp-$r->logindate > (3*60)){

                MemberW::where('id', Auth::guard('member')->user()->id)->update([
                    'logindate' => $timestamp,
                ]);

                $Userfrom = "";
                if(!in_array($ipAddress,['127.0.0.1','localhost'])){

                    $reader = new Reader(app_path('Plugin/GeoLite2-Country.mmdb'));
                    $record = $reader->country($ipAddress);
                    $Userfrom = $record->country->name;
                } else {
                    $Userfrom = "本機IP";
                }

                //print($record->country->name);exit;

                $Shistory = MemberShistoryR::select('logindate')->where('id',Auth::guard('member')->user()->id)->where('logindate','>',$today_start)->groupBy('logindate')->limit(1)->count();
                if($Shistory > 0){
                    MemberShistoryW::where('id', Auth::guard('member')->user()->id)->where('logindate','>',$today_start)->update([
                        'ip'    =>  $ipAddress,
                        'from'  =>  $Userfrom,
                        'logindate' => $timestamp,
                    ]);
                } else {
                    MemberShistoryW::insertGetId([
                        'id'    => Auth::guard('member')->user()->id,
                        'ip'    =>  $ipAddress,
                        'from'  =>  $Userfrom,
                        'logindate' => $timestamp,
                    ]);
                }
            }

        }



        return $next($request);
    }
}
