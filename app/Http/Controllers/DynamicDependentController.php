<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\JudicialRelation;
use App\Role;

class DynamicDependentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function judicials(Request $request){

        $request->user()->authorizeRoles(['admin', 'agent']);

        if($request->ajax()){

            $judicials = JudicialRelation::where('user_id', $request->value)->with(
                'judicial',
                'user',
                'agent')->get();

            return response()->json(['status'=>'success','data'=>$judicials]);
        }
    }

    public function profile(Request $request){

        $request->user()->authorizeRoles(['admin', 'agent']);

        if($request->ajax()){

            if( $request->role_id == 2){
                $value = 3;
            }else{
                $value = 2;
            }


            $update = DB::table('role_user')
              ->where('user_id', $request->user_id)
              ->update(['role_id' => $value]);

            return response()->json(['status'=>'success','data'=>$update]);
        }
    }
}
