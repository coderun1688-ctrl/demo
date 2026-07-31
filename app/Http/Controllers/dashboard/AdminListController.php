<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminR;
use App\Models\AdminW;

class AdminListController extends Controller{

    public  function index(Request $request){

        $input =   $request->all();


        $managdb = AdminR::select('*')->orderBy('logindate', 'desc');

        $SearchKeyword = '';
        if(isset($input['SearchKeyword'])){
            $managdb =  $managdb->whereAll([
                'username',
            ], 'like', '%'.$input['SearchKeyword'].'%');
            $SearchKeyword = $input['SearchKeyword'];
        }

        $managdb =  $managdb->paginate(10);



        @include(storage_path('app/private/AdminPermission.php'));

        return view('dashboard.AdminList',compact('managdb','AdminPermissionlist','SearchKeyword'));
    }

    public function DeleteData(Request $request){
        $input =   $request->all();
        if(!isset($input['id'])){

            return response()->json([
                'status'    =>  false,
                'message' => '不存在 id'
            ]);

        }

        AdminW::where('id',$input['id'])->delete();
        
        return response()->json([
            'status'    =>  true,
            'message' => ''
        ]);

    }

    public function UploadEnableData(Request $request){
        $input =   $request->all();


        if(!isset($input['id'])){

            return response()->json([
                'status'    =>  false,
                'message' => '不存在 id'
            ]);

        }

        AdminW::where('id', '=', $input['id'])->update([
            'active'  =>  $input['active'],
        ]);


        return response()->json([
            'status'    =>  true,
            'message' => ''
        ]);
    }

    public function UploadDisableData(Request $request){
        $input =   $request->all();


        if(!isset($input['id'])){

            return response()->json([
                'status'    =>  false,
                'message' => '不存在 id'
            ]);

        }

        AdminW::where('id', '=', $input['id'])->update([
            'active'  =>  $input['active'],
        ]);

        return response()->json([
            'status'    =>  true,
            'message' => ''
        ]);
    }

    public function AddData(){

        @include(storage_path('app/private/AdminPermission.php'));

        return view('dashboard.AdminAddData',compact('AdminPermissionlist'));
    }

    public function UploadAddData(Request $request){

        $input =   $request->all();


        if(AdminR::where('username', $input['username'])->count()>0){
            return response()->json([
                'status'    => false,
                'message' => '已存在帳號'
            ]);
        }



        AdminW::insertOrIgnore([
            'username'  =>  $input['username'],
            'groups'    =>  $input['groups'],
            'email'     =>  $input['email'],
            'password'  =>   Hash::make($input['password']),
            'registerdate'  =>  time(),
            'logindate'     =>  time(),
            'active'        =>  0
        ]);



        return response()->json([
            'status'    =>  true,
            'message' => ''
        ]);
    }



    public function EditData($id,$page){

        if(!isset($id)){
            return back()
                ->withErrors(['item' => '不存在 id'])
                ->withInput();
        }

        $Admindb = AdminR::where('id', $id)->first();

        if(!isset($Admindb->id)){
            return back()
                ->withErrors(['item' => '不存在 id'])
                ->withInput();
        }


        @include(storage_path('app/private/AdminPermission.php'));

        return view('dashboard.AdminEditData',compact('AdminPermissionlist','Admindb','id','page'));
    }

    public function UploadEditData(Request $request){
        $input =   $request->all();


        if(!isset($input['id'])){

            return response()->json([
                'status'    =>  false,
                'message' => '不存在 id'
            ]);

        }

        AdminW::where('id', '=', $input['id'])->update([
            'username'  =>  $input['username'],
            'groups'    =>  $input['groups'],
            'email'     =>  $input['email'],
        ]);

        if(isset($input['password'])){
            AdminW::where('id', '=', $input['id'])->update([
                'password'  =>   Hash::make($input['password']),
            ]);
        }



        return response()->json([
            'status'    =>  true,
            'message' => ''
        ]);

    }


}