<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\AdminPermissionR;
use App\Models\AdminPermissionW;
use App\Models\AdminvalueR;
use App\Models\AdminvalueW;

class PermissionController extends Controller{

    public  function index(){

        $managdb = AdminPermissionR::orderBy('id')->get();

        $pid = AdminPermissionR::orderBy('id', 'desc')->limit(1)->first();



        return view('dashboard.Permission',compact('managdb','pid'));
        
    }

    public  function GenerateCache(){


        $AdminPermissionDB = AdminPermissionR::orderBy('id')->get();
        $str = "<?php\n\$AdminPermissionlist=[\n";
        foreach ($AdminPermissionDB as $key=>$value){

            $str.= "\t'$value->id'\t=>\t'$value->levelname',\n";

        }

        $str.= "];\n?>";


        Storage::put('AdminPermission.php',$str, 'private');

    }

    public function UploadData(Request $request){

        $input =   $request->all();

        if(isset($input['setting'])){
            foreach ($input['setting'] as $key=>$value){
                if (AdminPermissionR::where('id', '=', $key)->exists()) {
                    AdminPermissionW::where('id', '=', $key)->update(['levelname' => $value['levelname']]);
                } else {
                    AdminPermissionW::insertOrIgnore(['levelname' => $value['levelname']]);
                }
            }
        }

        $this->GenerateCache();
        return response()->json([
            'status'    =>  true,
            'message' => ''
        ]);
    }


    public function DeleteData(Request $request)
    {
        $input =   $request->all();

        if(isset($input['id'])){


            AdminPermissionW::where('id', '=', $input['id'])->delete();

            AdminvalueW::where('id', '=', $input['id'])->delete();

            if (File::exists(storage_path('app/private/groupid'.$input['id'].'.php'))) {
                File::delete(storage_path('app/private/groupid'.$input['id'].'.php'));
            }

            $this->GenerateCache();

            return response()->json([
                'status'    =>  true,
                'message' => ''
            ]);

        }  else {

            return response()->json([
                'status'    =>  false,
                'message' => '錯誤 id'
            ]);
        }
    }

    public function Levelvalue($id){

        if(!isset($id)){
            return back()->withErrors(['item' => '不存在 id'])->withInput();
        }

        $AdminGroupid = $AdminPermissionlist  = $MenuList = [];

        @include(app_path('Plugin/Menu.php'));

        @include(storage_path('app/private/AdminPermission.php'));

        @include(storage_path('app/private/groupid'.$id.'.php'));

        //$AdminGroupid = ['OpenBackend'=>1,'Member'=>1];


        return view('dashboard.Adminvalue',compact('id','AdminPermissionlist','AdminGroupid','MenuList'));

    }

    public function LevelvalueUpload(Request $request){

        $input =   $request->all();

        if(isset($input['Setting'])){

            foreach ($input['Setting'] as $key  =>  $value){

                if (AdminvalueR::where('id', '=',$input['id'])->where('key', '=', $key)->exists()) {
                    AdminvalueW::where('id', '=',$input['id'])->where('key', '=', $key)->update(['value'=>$value]);
                } else {
                    AdminvalueW::insertOrIgnore(['id'   => $input['id'],'key' =>$key,'value'=>$value]);
                }
            }

            $this->GroupidCache($input['id']);

            return response()->json([
                'status'    =>  true,
                'message' => ''
            ]);

        }  else {

            return response()->json([
                'status'    =>  false,
                'message' => '錯誤權限'
            ]);
        }

    }
    public  function GroupidCache($id){

        $AdminvalueDB = AdminvalueR::where('id', '=',$id)->orderBy('id')->get();
        $str = "<?php\n\$AdminGroupid=[\n";
        foreach ($AdminvalueDB as $key=>$value){
            $str.= "\t'$value->key'\t\t=>\t'$value->value',\n";
        }
        $str.= "];\n?>";

        Storage::put('groupid'.$id.'.php',$str, 'private');

    }

}