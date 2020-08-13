<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Role;
use App\File;
use App\JudicialRelation;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'agent']);
        $data = Role::with('users')->get();
        $users = $data[2]->users;

        return view('upload', compact('users'));
    }

    public function details(){
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'agent']);
        $agent_id = $request->user()->id;

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpeg,png,jpg,pdf',
            'user_id' => 'required',
            'judicial_id' => 'required'
        ], $messages = [
            'file.required' => 'Selecciona un archivo.',
            'file.mimes' => 'Formato no válido. Utiliza jpg, jpeg, png o pdf.',
            'user_id.required' => 'Selecciona un Usuario.',
            'judicial_id.required' => 'Selecciona un Expediente.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $judicial = JudicialRelation::where('judicial_id', $request->judicial_id)
        ->where('user_id', $request->user_id)
        ->with(
            'judicial',
            'user',
            'agent'
        )->first();
        
        $folder = 'user_'. $judicial->user_id;
        $expediente = $judicial->judicial->name;

        $count = File::where('user_id', $request->user_id)
        ->where('judicial_id', $request->judicial_id)->count();

        $folio = $count + 1;

        $extension = $request->file('file')->extension();

        if($extension == 'pdf'){
            $format = 'PDF';
        }else{
            $format = 'IMG';
        }

        $path = Storage::putFileAs('files/'.$folder, $request->file('file'), $expediente.'_'.$folio.'.'.$extension);

        $FileRequest = new File();

        $FileRequest->url = $path;
		$FileRequest->agent_id = $agent_id;
		$FileRequest->user_id = $request->user_id;
        $FileRequest->judicial_id = $request->judicial_id;
        $FileRequest->format = $format;

        $FileRequest->save();
        return redirect()->route('upload_file')->with('status', 'Profile updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
