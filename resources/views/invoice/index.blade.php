@extends('layouts.app')

@section('content')
<div class="container-fluid ">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>{{ __('Alle Rechnungen') }}</h1>
                    <a type="button" class="h3 btn btn-primary" href="{{ route('invoice.create')}}">+ {{ __('Add New Invoice') }}</a>
                </div>
                        
                <div class="card-body row">
                <table class="table table-striped">
                   <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Datum') }}</th>
                            <th scope="col">{{ __('Kunde') }}</th>
                            <th scope="col">{{ __('Beschreibung') }}</th>
                            <th class="text-right" scope="col">{{ __('Netto') }}</th>
                            <th class="text-right" scope="col">{{ __('MwSt') }}</th>
                            <th class="text-right" scope="col">{{ __('Brutto') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Aktionen') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->invoices as $invoice)
                        <tr>
                        
                            <td class="text-right">{{$invoice->invoice_number}}</td>
                            <td class="invoice_date">{{date("d.m.Y", strtotime($invoice->invoice_date))}}</td>
                            <th scope="row">{{$customer::whereId($invoice->customer_id)->first()->name}}</th>
                            <td> {{$invoice->invoice_description}}</td>
                            <td class="text-right">{{number_format((float)$invoice->netto_total, 2, ',', '')}}€</td>
                            <td class="text-right"> {{number_format(floatval($invoice->brutto_total) - floatval($invoice->netto_total), 2, ',', '')}}€</td>
                            <th class="text-right" scope="row"> {{number_format((float)$invoice->brutto_total, 2, '.', '')}}€</th>
                            <th class="text-right" scope="row"> {{$invoice->invoice_state}}</th>
                            <td>
                                <a type="button" class="pdfDownload">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M14 2v11h2.51l-4.51 5.01-4.51-5.01h2.51v-11h4zm2-2h-8v11h-5l9 10 9-10h-5v-11zm3 19v3h-14v-3h-2v5h18v-5h-2z"/></svg>
                                </a>
                                 <input type="hidden" class="hidden_invoice_data" value="{{$invoice}}">

                                <a type="button" class="edit_invoice ml-2" href="{{route('invoice.edit', $invoice->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M18.363 8.464l1.433 1.431-12.67 12.669-7.125 1.436 1.439-7.127 12.665-12.668 1.431 1.431-12.255 12.224-.726 3.584 3.584-.723 12.224-12.257zm-.056-8.464l-2.815 2.817 5.691 5.692 2.817-2.821-5.693-5.688zm-12.318 18.718l11.313-11.316-.705-.707-11.313 11.314.705.709z"/></svg>
                                </a>  
                                <a type="button" class="edit_invoice ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.015 7c4.751 0 8.063 3.012 9.504 4.636-1.401 1.837-4.713 5.364-9.504 5.364-4.42 0-7.93-3.536-9.478-5.407 1.493-1.647 4.817-4.593 9.478-4.593zm0-2c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 3c-2.21 0-4 1.791-4 4s1.79 4 4 4c2.209 0 4-1.791 4-4s-1.791-4-4-4zm-.004 3.999c-.564.564-1.479.564-2.044 0s-.565-1.48 0-2.044c.564-.564 1.479-.564 2.044 0s.565 1.479 0 2.044z"/></svg>
                                </a>
                            </td>
                        </tr>
                        </div>
                        @endforeach
                    </tbody>
                    </table>
            </div>
        </div>

    </div>
</div>
@endsection

