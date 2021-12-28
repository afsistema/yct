<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        $customers = Customer::orderBy('id')->paginate(5);

        $users = User::select('id', 'name')->orderBy('name')->get();

        return view('customer/index', compact('customers', 'users'));
    }

    public function create($id)
    {
        $users = User::select('id', 'name')->orderBy('name')->get();
        $customer = Customer::findOrNew($id);
        return view('customer/create', compact('customer', 'users'));
    }

    public function save($id, Request $request)
    {
        $customer = Customer::findOrNew($id);
        $customer->user_id = $request->user_id;
        $customer->name = $request->name;
        $customer->document = $request->document;
        $customer->status = $request->status;
        $customer->save();
        $request->session()->flash('status', 'Cliente salvo com sucesso!');
        return redirect('/customer');
    }  

    public function delete($id, Request $request)
    {
        $customer = Customer::find($id);       
        $customer->delete();
        $request->session()->flash('status', 'Cliente apagado com sucesso!');
        return redirect('/customer');
    }
}
