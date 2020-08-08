<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JudicialRelation;

class DynamicDependentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function judicials(Request $request){

        if($request->ajax()){

            $judicials = JudicialRelation::where('user_id', $request->value)->with(
                'judicial',
                'user',
                'agent')->get();

            return response()->json(['status'=>'success','data'=>$judicials]);
        }
    }
}
