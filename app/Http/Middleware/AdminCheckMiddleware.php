<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\SupportStream\Facades\View;
use App\Models\AdminR;
use App\Models\AdminW;
class AdminCheckMiddleware{

    public function handle(Request $request, Closure $next): Response{

        // Check if the user is authenticated and is an administrator
        if (!Auth::guard('admin')->check()) {
            return redirect('/dashboards/login');
        }

        $inputs = $request->all();
        foreach ($inputs as $key => $value) {
            if (is_string($value)) {
                if(!in_array($key,['content'])){
                    $inputs[$key] = $this->SearchFilter($value);
                }

            }
        }
        $request->replace($inputs);

        @include(storage_path('app/private/SuperAdmin.php'));

        $Routename = Route::currentRouteName();
        $timestamp = time();
        if(!in_array($Routename,['logout'])){

            $Admindb = AdminR::where('id', Auth::guard('admin')->user()->id)->first();
            if(isset($Admindb->active)){
                if($Admindb->active == 0){
                    Auth::guard('admin')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->route('login');

                } else if($timestamp - $Admindb->logindate > 5 * 60){
                    $Admindb->where('id', '=', $Admindb->id)->update([
                        'logindate'  =>  $timestamp,
                    ]);
                }
            }

            //不是超級管理員權限
            if(in_array(Auth::guard('admin')->user()->id,$SuperAdminlist) && in_array($Routename,['SystemSteeing','Main','SuperAdmin','AdminList','Permission','Personal'])) {
                return $next($request);
            } else {
                if(!in_array($Routename,['Main','Personal'])) {
                    @include(storage_path('app/private/groupid' . Auth::guard('admin')->user()->groups . '.php'));
                    if (!isset($AdminGroupid['OpenBackend']) || !$AdminGroupid['OpenBackend']) {
                        return response()->view('dashboard.Permissionissue');
                    } else if (!isset($AdminGroupid[$Routename]) || !$AdminGroupid[$Routename]) {
                        return response()->view('dashboard.Permissionissue');
                    }
                }
            }

        }
        return $next($request);


    }


    public function SearchFilter($string) {
        $dropmatch = ['^', '`', '\'', '"', 'or','=','x','update','select','where','java','script','iframe',
            'insert','into','delete','../','mysqli_','eval','assert','preg_replace','create_function','system','exec','passthru','shell_exec'];

        return str_ireplace($dropmatch, '', $string);

    }

}