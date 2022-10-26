@extends('layouts.app')

@section('content')
<div class="container-fluid dashboard-page">
    <div class="row justify-content-center">
        <div class="container">
            <div class="main-content">
            <customer-invoice-header-component header-title="{{__('Dein Dashboard')}}" add-button="{{__('neue Rechnung')}}" add-button-url="{{ route('invoice.create')}}"></customer-invoice-header-component>
    

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
                    <div class="row sales-overview d-flex">
                        <div class="sales-alltime col-sm-4">
                            <div class=" shadow-sm p-3 bg-white">
                                <h2>Seit Beginn</h2>
                                <hr class="col-2">
                                <div class="row">
                                    <div class="col-sm-6 netto">
                                        <span>Netto</span>
                                        <p class="sum h5">{{$data["allTime"]["netto"]}}€</p>
                                    </div>
                                    <div class="col-sm-6 brutto">
                                        <span>Brutto</span>
                                        <p class="sum h5">{{$data["allTime"]["brutto"]}}€</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sales-thisyear col-sm-4">
                            <div class="shadow-sm p-3 bg-white">
                                <div class="d-flex align-items-end">
                                <h2>Dieses Jahr <span class="">{{$data["thisYear"]["year"]}}</span></h2>
                                
                                </div>
                                <hr class="col-2">
                                <div class="row">
                                    <div class="col-sm-6 netto">
                                        <span>Netto</span>
                                        <p class="sum h5">{{$data["thisYear"]["netto"]}}€</p>
                                    </div>
                                    <div class="col-sm-6 brutto">
                                        <span>Brutto</span>
                                        <p class="sum h5">{{$data["thisYear"]["brutto"]}}€</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sales-lastyear col-sm-4">
                            <div class="shadow-sm p-3 bg-white">
                                <h2>{{$data["lastYear"]["year"]}}</h2>
                                <hr class="col-2">
                                <div class="row">
                                    <div class="col-sm-6 netto">
                                        <span>Netto</span>
                                        <p class="sum h5">{{$data["lastYear"]["netto"]}}€</p>
                                    </div>
                                    <div class="col-sm-6 brutto">
                                        <span>Brutto</span>
                                        <p class="sum h5">{{$data["lastYear"]["brutto"]}}€</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</div>
@endsection
