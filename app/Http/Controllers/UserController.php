<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->roles  == 'Administrador') {
            $users = User::orderBy('id')->paginate(5);
            return view('user/index', compact('users'));
        }
    }

    public function create($id)
    {
        if (Auth::user()->roles  == 'Administrador') {
            $user = User::findOrNew($id);
            return view('user/create', compact('user'));
        }
    }

    public function save($id, Request $request)
    {
        if (Auth::user()->roles  == 'Administrador') {
            $user = User::findOrNew($id);
            $user->name = $request->name;
            $user->roles  = $request->roles;
            $user->email = $request->email;
            $user->status = $request->status;

            if ($request->password != "") {
                $user->password = bcrypt($request->password);
            }
            $user->save();
            $request->session()->flash('status', 'Usuário salvo com sucesso!');
            return redirect('/user');
        }
    }     

    public function delete($id, Request $request)
    {
        if (Auth::user()->roles  == 'Administrador') {
            $user = User::find($id);
            $user->delete();
            $request->session()->flash('status', 'Usuário apagado com sucesso!');
            return redirect('/user');
        }
    }
}
