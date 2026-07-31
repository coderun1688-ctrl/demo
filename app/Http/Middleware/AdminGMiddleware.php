<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminGMiddleware{

    public function handle(Request $request, Closure $next): Response{

        $inputs = $request->all();
        foreach ($inputs as $key => $value) {
            if (is_string($value)) {
                $inputs[$key] = $this->SearchFilter($value);
            }
        }
        $request->replace($inputs);

        // Check if the user is logged in AND is an admin
//        if (Auth::guard('admin')->check()) {
//            return redirect('/dashboards');
//        }

        // Allow the request to pass to the next layer (controller or route)
        return $next($request);
    }

    public function SearchFilter($string) {
        $dropmatch = ['(',')','^', '$', '<', '>', '`', '\'', '"', '|', '[', ']', '{', '}', '#', ';', '!', '=', '*','or','=','x','update','select','where','java','script','iframe',
            'insert','into','delete','../','mysqli_','eval','assert','preg_replace','create_function','system','exec','passthru','shell_exec'];

        return str_ireplace($dropmatch, '', $string);

    }

}