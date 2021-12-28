<?php

namespace App\Http\Controllers;

use App\Models\NumberPreference;

class NumberPreferenceController extends Controller
{
    public function index()
    {
        $number_preferences = NumberPreference::orderBy('id')->paginate(5);
        return view('number_preferences/index', compact('number_preferences'));
    }

    public function create($id)
    {
        $number_preference = NumberPreference::findOrNew($id);
        return view('number_preference/create', compact('number_preference'));
    }

    public function save($id, Request $request)
    {
        $number_preference = NumberPreference::findOrNew($id);
        $number_preference->name = $request->name;
        $number_preference->document = $request->document;
        $number_preference->status = $request->status;
        $number_preference->save();
        $request->session()->flash('status', 'Custoners salvo com sucesso!');
        return redirect('/number_preference');
    }  

    public function delete($id, Request $request)
    {
        $number_preference = NumberPreference::find($id);
        $number_preference->logs()->delete();
        $number_preference->delete();
        $request->session()->flash('status', 'Customer apagada com sucesso!');
        return redirect('/number_preference');
    }
}
