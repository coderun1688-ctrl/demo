<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminR;
use App\Models\AdminW;

class PersonalController extends Controller{

    public  function index(){

        return view('dashboard.Personal');
    }

    public function UploadData(Request $request){

        $input =   $request->all();
        if(isset($input['password'])){

            AdminW::where('id', '=', Auth::guard('admin')->user()->id)->update([
                'password'  =>   Hash::make($input['password'])
            ]);

        }



        return response()->json([
            'status'    =>  true,
            'message' => ''
        ]);
    }
}
