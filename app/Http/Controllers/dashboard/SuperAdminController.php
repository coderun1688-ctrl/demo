<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\AdminR;
use App\Models\AdminW;
use App\Models\AdminSuperR;
use App\Models\AdminSuperW;
class SuperAdminController extends Controller{

    public  function index(){

        $managdb = AdminSuperR::select('adminsuper.*', 'adminlist.username')->
        leftJoin('adminlist', 'adminsuper.owner', '=', 'adminlist.id')->
        orderBy('postdate')->paginate(10);


        return view('dashboard.SuperAdmin',compact('managdb'));
    }

    public  function GenerateCache(){


        $AdminSuperDB = AdminSuperR::orderBy('postdate')->get();
        $str = "";
        foreach ($AdminSuperDB as $key=>$value){

            $str.= $str ? ",'{$value->owner}'" : "'{$value->owner}'";
        }

        Storage::put('SuperAdmin.php',"<?php\n\$SuperAdminlist=[".$str."];\n?>", 'private');

    }


    public  function DeleteData(Request $request){
        $input =   $request->all();

        if(!isset($input['id'])){
            return response()->json([
                'status'    =>  false,
                'message' => '不在 id'
            ]);
        }


        AdminSuperW::where('id',$input['id'])->delete();

        $this->GenerateCache();

        return response()->json([
            'status'    =>  true,
            'message' => ''
        ]);
    }
    public  function AddData(Request $request){
        $input =   $request->all();

        $r = AdminR::where('username',$input['adminusername'])->first();
        if(!isset($r->username)){
                return response()->json([
                    'status'    =>  false,
                    'message' => '不在管理員帳號'
                ]);
        }

        if(AdminSuperR::where('owner',$r->id)->count() > 0){
            return response()->json([
                'status'    =>  false,
                'message' => '超級管理員帳號已存在'
            ]);
        }

        AdminSuperW::insertOrIgnore([
            'owner' =>  $r->id,
            'postdate'  =>  time()
        ]);

        $this->GenerateCache();

        return response()->json([
            'status'    =>  true,
            'message' => ''
        ]);

    }
}