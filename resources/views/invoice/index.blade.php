@extends('layouts.app')

@section('content')
<div class="container-fluid ">
    <div class="row justify-content-center">
        <div class="container">
            <div class="main-content">
                <customer-invoice-header-component header-title="{{__('Alle Rechnungen')}}" add-button="{{__('neue Rechnung')}}" add-button-url="{{ route('invoice.create')}}"></customer-invoice-header-component>
                
                <invoice-list-container></invoice-list-container>
                <div class="invoice-list col-12">
                   <!-- <div class="row d-flex">
                        @foreach(Auth::user()->invoices as $invoice)
                            <invoice-list-element-component invoice="{{$invoice}}" mwst="{{$invoice->mwst_total}}" edit-route="{{route('invoice.edit', $invoice->id)}}"></invoice-list-element-component>
                        @endforeach

                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

