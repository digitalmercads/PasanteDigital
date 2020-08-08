<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\JudicialType;
use App\Judicial;
use App\JudicialRelation;

class JudicialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin']);

        $judicialTypes = JudicialType::all();
        $judicials = JudicialRelation::where('user_id', $request->user()->id)->with(
            'judicial',
            'user',
            'agent'
        )->get();

        return view('judicial', compact(
            'judicialTypes',
            'judicials'
        ));
    }

    public function store(Request $request){

        $request->user()->authorizeRoles(['user', 'admin']);
        $idusuario = $request->user()->id;

		$validator = Validator::make(
			$request->all(),
			[
				'name' => 'required|string',
				'actor' => 'required|string',
                'court' => 'required|string',
                'type' => 'required'
			],
			$messages = [
				'name.required' => 'Ingresa N° de Expediente.',
				'name.string' => 'Formato de Expediente no válido.',
				'actor.required' => 'Ingresa el nombre del Actor.',
                'actor.string' => 'Carácteres no válidos.',
                'court.required' => 'Ingresa el número de Juzgado.',
				'court.string' => 'Carácteres no válidos.',
                'type.required' => 'Selecciona la Materia.'
			]
        );

		if ($validator->fails()) {
			return  back()->withErrors($validator)
            ->withInput()
            ->with('status','fail');
        }

        $judicialRequest = new Judicial();

        $judicialRequest->name = $request->name;
		$judicialRequest->actor = $request->actor;
		$judicialRequest->court = $request->court;
		$judicialRequest->type_id = $request->type;
		$judicialRequest->status = 0;

        $judicialRequest->save();

        $idJudicial = $judicialRequest->id;

        $judicialRelation = new JudicialRelation();

        $judicialRelation->judicial_id = $idJudicial;
        $judicialRelation->user_id = $idusuario;

        $judicialRelation->save();

		return redirect()->route('judicial')->with('status','success');
    }

    public function showfiles(Request $request){
        $request->user()->authorizeRoles(['user', 'admin']);
        $judicial_id = $request->route('id');



        return view('details');
    }
}
