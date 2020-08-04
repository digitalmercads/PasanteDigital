<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $profiles = User::with('roles')->get();
        $roles = Role::all();

        return view('profiles', compact('profiles', 'roles'));

        /*$
        $judicials = JudicialRelation::where('user_id', $request->user()->id)->with(
            'judicial',
            'user',
            'agent'
        )->get();
        $agents = Role::where('id', 2)->with('users')->get();
        return view('judicial', compact(
            'judicialTypes',
            'judicials'
        ));*/
    }
}
