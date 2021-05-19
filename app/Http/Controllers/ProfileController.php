<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
    public function index()
    {
        return view('profile.index');
    }
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'street'=> 'required',
            'city'=> 'required',
            'zip'=> 'required',
            'country'=> 'required',
            'mail'=> 'required',
            'phone'=> '',
            'url'=> '',
            'tax_id'=> '',
            'invoice_counter'=> '',
            'rate_per_hour_default'=> '',
            'tax_id'=> '',
            'iban'=> '',
            'bic'=> '',
            'bank'=> '',

           ]);
           auth()->user()->profile()->create($data);
           return redirect('/profile');
    }
    public function update()
    {
        $data = request()->validate([
            'name' => 'required',
            'street'=> 'required',
            'city'=> 'required',
            'zip'=> 'required',
            'country'=> 'required',
            'mail'=> 'required',
            'phone'=> '',
            'url'=> '',
            'tax_id'=> '',
            'invoice_counter'=> '',
            'rate_per_hour_default'=> '',
            'tax_id'=> '',
            'iban'=> '',
            'bic'=> '',
            'bank'=> '',

           ]);
           auth()->user()->profile()->update($data);
           return redirect('/profile');
    }
    public function show()
    {
        $profile = Auth::user()->profile();
        return $profile;
    }
}
