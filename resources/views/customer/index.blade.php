@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="main-content">
                <customer-invoice-header-component header-title="{{__('Alle Kunden')}}" add-button="{{__('neuer Kunde')}}" add-button-url="{{ route('customer.create')}}"></customer-invoice-header-component>
                <div class="row">
                   <div class="col-md-12">
                        <div class="customer row d-flex">
                            @foreach(Auth::user()->customers as $customer)
                            <customer-overview-component customer="{{$customer}}"></customer-overview-component>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-12">
        </div>
    </div>
</div>
@endsection