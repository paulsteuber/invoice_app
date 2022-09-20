<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Carbon\Carbon;
use \App\Models\Invoice;
use \App\Helpers\ChiaFormat;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
        $user = Auth::user();
        $data = array();

        $invoices = $user->invoices;
        $invoicesThisYear = Invoice::whereYear('invoice_date', Carbon::now()->year)->where("user_id",$user->id)->get();
        $invoicesLastYear = Invoice::whereYear('invoice_date', Carbon::now()->year - 1)->where("user_id",$user->id)->get();
        
        //$userInvoice = $user->invoices;
        $data["allTime"]= array(
            "brutto" => ChiaFormat::toPrice($invoices->sum('brutto_total')),
            "netto" => ChiaFormat::toPrice($invoices->sum('netto_total'))
        );
        $data["thisYear"]= array(
            "year" => Carbon::now()->year,
             "brutto" => ChiaFormat::toPrice($invoicesThisYear->sum('brutto_total')),
             "netto" => ChiaFormat::toPrice($invoicesThisYear->sum('netto_total')),
         );
         $data["lastYear"]= array(
            "year" => Carbon::now()->year - 1,
             "brutto" => ChiaFormat::toPrice($invoicesLastYear->sum('brutto_total')),
             "netto" => ChiaFormat::toPrice($invoicesLastYear->sum('netto_total')),
         );
        
        return view('home', compact('data'));
    }
}
