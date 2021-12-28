<?php

namespace App\Http\Controllers;

use App\Models\Number;
use App\Models\Customer;
use App\Models\NumberPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NumberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $numbers = Number::orderBy('id');
        if(Auth::user()->roles  != 'Administrador') {
            $numbers = $numbers->whereHas('customer', function($query) {
                $query->where('user_id', Auth::user()->id);
            });  
        }
        
        $numbers = $numbers->paginate(5);
        $customers = Customer::select('id', 'name')->orderBy('name')->get();
        return view('number/index', compact('numbers', 'customers'));
    }

    public function create($id)
    {
        
        $number = Number::findOrNew($id);      
        $customers = Customer::select('id', 'name')->orderBy('name')->get();        
        return view('number/create', compact('number', 'customers'));
    }

    public function save($id, Request $request)
    {
        $number = Number::findOrNew($id);
        $number->customer_id = $request->customer_id;
        $number->number = $request->number;
        $number->status = $request->status;
        $number->save();

        $number->number_preferences()->delete();
        if (isset($request->preferences)) {
            foreach ($request->preferences as $preference) {
                if ($preference['preference_name'] != "" || $preference['preference_value'] != "" ) {
                    $item2 = new NumberPreference();
                    $item2->number_id = $number->id;
                    $item2->name = $preference['preference_name'];
                    $item2->value = $preference['preference_value'];                    
                    $item2->save();
                }
            }
        }

        if($number->status_preferences != 1) {
            $item = new NumberPreference();
            $item->number_id = $number->id;
            $item->name = 'auto_attendant';
            $item->value = '1';
            $item->save();

            $item = new NumberPreference();
            $item->number_id = $number->id;
            $item->name = 'voicemail_enabled';
            $item->value = '1';
            $item->save();
        }
         $number->status_preferences = 1; 
         $number->save();     
         
         
         
        $request->session()->flash('status', 'Número salvo com sucesso!');
        return redirect('/number');
    }     

    public function delete($id, Request $request)
    {
        $number = Number::find($id);
        $number->number_preferences()->delete();  
        $number->delete();
        $request->session()->flash('status', 'Número apagado com sucesso!');
        return redirect('/number');
    }

    public function show($id)
    {
        $number = Number::find($id);
        $customers = Customer::select('id', 'name')->orderBy('name')->get();
        return view('number/show', compact('number', 'customers'));
    }
}
