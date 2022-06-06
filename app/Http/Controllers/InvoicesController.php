<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Customer;
use \App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller
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
    public function index(Customer $customer)
    {
        return view('invoice.index',compact('customer'));
    }
    public function create()
    {
        $user = Auth::user();
        $defaultInvoiceNumber = $user->profile ? intval($user->profile->invoice_counter) : 1;
        $nextInvoiceNumber = $user->invoices->max('invoice_number')? $user->invoices->max('invoice_number')+1 : 1;
        if($defaultInvoiceNumber > $nextInvoiceNumber){
            $nextInvoiceNumber = $defaultInvoiceNumber;
        }
        return view('invoice.create', compact('user', 'nextInvoiceNumber'));
    }
    public function store()
    {
        // validate invoice partial pay
        request()->merge(['invoice_partial_pay' => request()->has('invoice_partial_pay')]);
       /*  request()->merge([
            'invoice_partial_pay' => strcmp(request()->invoice_partial_pay, 'true') || strcmp(request()->invoice_partial_pay, '1') ? 1 : 0,
         ]);
        
        */
        $data=request()->validate([
            //CUSTOMER INFORMATIONS
            'customer_id' => 'required',
            'customer_name' => 'required',
            'customer_alias' => '',
            'customer_street'=> 'required',
            'customer_zip'=> 'required',
            'customer_city'=> 'required',
            'customer_mail'=> 'required',
            'customer_website'=> '',
            'name' => 'required',
            'street' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'mail' => 'required',
            'url' => 'required',
            'phone' => 'required',
            'iban' => 'required',
            'bank' => 'required',
            'bic' => 'required',
            'tax_id' => '',
            'invoice_number' => 'required',
            'invoice_description' => 'required',
            'invoice_date' => 'required',
            'invoice_partial_pay' => 'boolean',
            'invoice_partial_pay_date' => '',
            'invoice_partial_pay_sum' => '',
            'invoice_pay_date' => 'required',
            'invoice_state' => 'required',
            'invoice_additional' => '',
            'all_positions' => 'required',
            'netto_total' => 'required',
            'mwst_total' => 'required',
            'brutto_total' => 'required'


           ]);
           auth()->user()->invoices()->create($data);
           return redirect('/invoices');
    }
    
   public function edit( $invoice_id){
        //$this->authorize('update', Invoice::find($invoice_id));
        $user = Auth::user();
        $invoice = Invoice::find($invoice_id);
        return view('invoice.edit', compact('user'), compact('invoice'));
    }
    public function show_invoice($invoice_id){
        //$this->authorize('show_invoice', Invoice::find($invoice_id));
        return Invoice::find($invoice_id);
    }
    public function update($invoice_id)
    {
         // validate invoice partial pay
        request()->merge(['invoice_partial_pay' => request()->has('invoice_partial_pay')]);
        /*
        request()->merge([
            'invoice_partial_pay' => strcmp(request()->invoice_partial_pay, 'true') || strcmp(request()->invoice_partial_pay, '1') ? 1 : 0,
         ]);
         */
        //return request();
        $data = request()->validate([
            
            'customer_id' => 'required',
            'customer_name' => 'required',
            'customer_alias' => '',
            'customer_street'=> 'required',
            'customer_zip'=> 'required',
            'customer_city'=> 'required',
            'customer_mail'=> 'required',
            'customer_website'=> '',
            'name' => 'required',
            'street' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'mail' => 'required',
            'url' => 'required',
            'phone' => 'required',
            'iban' => 'required',
            'bank' => 'required',
            'bic' => 'required',
            'tax_id' => '',
            'invoice_number' => 'required',
            'invoice_description' => 'required',
            'invoice_date' => 'required',
            'invoice_partial_pay' => 'boolean',
            'invoice_partial_pay_date' => '',
            'invoice_partial_pay_sum' => '',
            'invoice_pay_date' => 'required',
            'invoice_state' => 'required',
            'invoice_additional' => '',
            'all_positions' => 'required',
            'netto_total' => 'required',
            'mwst_total' => 'required',
            'brutto_total' => 'required'

           ]);
           $this_invoice = Invoice::find($invoice_id);
           $this_invoice->update($data);
           return redirect('/invoices');
    }
}
