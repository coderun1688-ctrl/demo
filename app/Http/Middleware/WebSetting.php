<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;
use App\Plugin\GlobalSettings;

class WebSetting{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        $SystemSteeing = GlobalSettings::getSystemSteeing();

        //print_r(GlobalSettings::getSystemSteeing());exit;

        if(isset($SystemSteeing['WebHome']) && $SystemSteeing['WebHome'] == 1){
            if(isset($SystemSteeing['CheckDefault'])){
                if($SystemSteeing['CheckDefault'] == 1) {
                    return response()->view('WebHome', ['content' => $SystemSteeing['content']]);
                } else  if($SystemSteeing['CheckDefault'] == 2){
                    http_response_code(500);
                    exit;
                }
            }
        }

        $inputs = $request->all();
        foreach ($inputs as $key => $value) {
            if (is_string($value)) {
                if(!in_array($key,['content','g-recaptcha-response'])){
                    $inputs[$key] = $this->SearchFilter($value);
                }

            }
        }
        $request->replace($inputs);

        View::share('SystemSteeing', $SystemSteeing);

        return $next($request);
    }

    public function SearchFilter($string) {
        $dropmatch = ['^', '`', '\'', '"', 'or','=','x','update','select','where','java','script','iframe',
            'insert','into','delete','../','mysqli_','eval','assert','preg_replace','create_function','system','exec','passthru','shell_exec'];
        return str_ireplace($dropmatch, '', $string);

    }
}
