<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Customer;
use Illuminate\Support\Facades\Auth;


class CustomersController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware('auth');
   }

   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function index(User $user)
   {
       return view('customer.index');
   }
   public function create(){
       return view('customer.create');
   }
   public function store(User $user){
       $data = request()->validate([
        'name' => 'required',
        'alias_name' => '',
        'street'=> 'required',
        'city'=> 'required',
        'zip'=> 'required',
        'country'=> 'required',
        'mail'=> 'required',
        'website'=> '',
        'tax_id'=> '',
        'rate_per_hour'=> ''
       ]);
       auth()->user()->customers()->create($data);
       return redirect('/customers');
   }
   public function update($customer_id){
    $this->authorize('update', Customer::find($customer_id));
    $data = request()->validate([
        'name' => 'required',
        'alias_name' => '',
        'street'=> 'required',
        'city'=> 'required',
        'zip'=> 'required',
        'country'=> 'required',
        'mail'=> 'required',
        'website'=> '',
        'tax_id'=> '',
        'rate_per_hour'=> ''
       ]);
       
       $customer = Customer::find($customer_id);
       $customer->update($data);
       return redirect('/customers');
   }
   public function edit(User $user,  $customer_id){
        $this->authorize('update', Customer::find($customer_id));
        $customer = Customer::find($customer_id);
        return view('customer.edit', compact('user'), compact('customer'));
    }

    public function show_customers(User $user){
        $customers = Auth::user()->customers;
        return $customers;
    }
}
