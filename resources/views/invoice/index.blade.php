@extends('layouts.app')

@section('content')
<div class="container-fluid ">
    <div class="row justify-content-center">
        <div class="container">
            <div class="main-content">
                <customer-invoice-header-component header-title="{{__('Alle Rechnungen')}}" add-button="{{__('neue Rechnung')}}" add-button-url="{{ route('invoice.create')}}"></customer-invoice-header-component>
                                       
                <table class="invoice-table">
                   <thead>
                        <tr>
                            <td scope="col">#</td>
                            <td scope="col">{{ __('Datum') }}</td>
                            <td scope="col">{{ __('Kunde') }}</td>
                            <td scope="col">{{ __('Beschreibung') }}</td>
                            <td class="text-right" scope="col">{{ __('Netto') }}</td>
                            <td class="text-right" scope="col">{{ __('MwSt') }}</td>
                            <td class="text-right" scope="col">{{ __('Brutto') }}</td>
                            <td scope="col">{{ __('Status') }}</td>
                            <td scope="col">{{ __('Aktionen') }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->invoices as $invoice)
                        <invoice-list-element-component invoice="{{$invoice}}" mwst="{{$invoice->mwst_total}}" edit-route="{{route('invoice.edit', $invoice->id)}}"></invoice-list-element-component>
                        <tr  class="shadow-sm">
                        
                            <td class="text-right">{{$invoice->invoice_number}}</td>
                            <td class="invoice_date">{{date("d.m.Y", strtotime($invoice->invoice_date))}}</td>
                            <td scope="row">{{Str::of($customer::whereId($invoice->customer_id)->first()->name)->limit(20)}}</td>
                            <td>{{Str::of($invoice->invoice_description)->limit(30)}}</td>
                            <td class="text-right netto">{{number_format((float)$invoice->netto_total, 2, ',', '')}} €</td>
                            <td class="text-right mwst"> {{number_format(floatval($invoice->brutto_total) - floatval($invoice->netto_total), 2, ',', '')}} €</td>
                            <td class="text-right brutto" scope="row"> {{number_format((float)$invoice->brutto_total, 2, ',', '')}} €</td>
                            <td class="text-right" scope="row"> {{$invoice->invoice_state}}</td>
                            <td>
                                <a type="button" class="pdfDownload">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                </svg>
                                </a>
                                 <input type="hidden" class="hidden_invoice_data" value="{{$invoice}}">

                                <a type="button" class="edit_invoice ml-2" href="{{route('invoice.edit', $invoice->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                    </svg>
                                </a>  
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

