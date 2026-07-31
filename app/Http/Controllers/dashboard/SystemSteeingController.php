<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\SystemSteeingR;
use App\Models\SystemSteeingW;


class SystemSteeingController extends Controller{

  public function index(){

        $managdb = [];

        $managdb = SystemSteeingR::orderBy('typekey', 'desc')->get();

        foreach ($managdb as $key => $value){
            $managdb[$value['typekey']] = $value['typevalue'];
        }
        return view('dashboard.SystemSteeing',compact('managdb'));
  }


  public function UploadData(Request $request){
        $input =   $request->all();


        SystemSteeingW::wherein('typekey', ['CheckDefault','WebHome',
            'reCAPTCHAV3regCheck','reCAPTCHAV3loginCheck',
            'reCAPTCHAV3ForgotPasswordCheck','reCAPTCHAV3ContactUsCheck','EmailCheck'
        ])->update([
          'typevalue'  =>  0,
        ]);

        SystemSteeingW::where('typekey', '=', 'content')->update([
          'typevalue'  =>  '',
        ]);


        if($request->hasFile('WebLogoFile')) {

            $request->validate([
                'WebLogoFile' => 'required|mimes:jpg,png,gif,webp|max:5120',
            ]);

            $file = $request->file('WebLogoFile');
            $allowedfileExtension=['pdf','jpg','png','gif','webp'];
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            if(in_array($extension,$allowedfileExtension)){
                $input['Steeing']['WebLogoFile'] = '/'.$file->storeAs('uploads', time().'.'.$extension, 'public');
                $r = SystemSteeingR::select('typevalue')->where('typekey',  'WebLogoFile')->first();
                if(isset($r->typevalue) && $r->typevalue){
                    File::delete(public_path($r->typevalue));
                }

            }

        }


        if(isset($input['Steeing'])){
            foreach ($input['Steeing'] as $key  =>  $value){
                if(SystemSteeingR::where('typekey', $key)->exists()){
                    SystemSteeingW::where('typekey', $key)->update(['typevalue' => $value]);
                } else {
                    SystemSteeingW::insertOrIgnore(['typekey'=> $key,'typevalue' => $value]);
                }

            }
        }



        $SystemSteeingDB = SystemSteeingR::orderBy('typekey', 'desc')->get();
        $str = "<?php\n\$SystemSteeing=[\n";
        foreach ($SystemSteeingDB as $key=>$value){

          $str.= "\t'$value->typekey'\t=>\t'".addslashes($value->typevalue)."',\n";

        }

        $str.= "];\n?>";


        Storage::put('SystemSteeing.php',$str, 'private');



        return response()->json([
          'status'    =>  true,
          'message' => ''
        ]);
  }


}
