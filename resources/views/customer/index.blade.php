@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>{{ __('Your Customers') }}</h1>
                    <a type="button" class="h3 btn btn-primary" href="{{ route('customer.create')}}">+ {{ __('Add New Customer') }}</a>
                </div>

                <div class="card-body row">
                   <div class="col-md-12">
                   <table class="table table-striped">
                   <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Mailadress</th>
                            <th scope="col">Rate / Hour</th>
                            <th scope="col">Open</th>
                            <th scope="col">Paid</th>
                            <th scope="col">Total</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->customers as $customer)
                        <tr>
                            <th scope="row">{{$customer->name}}  @if($customer->alias_name)({{$customer->alias_name}})@endif</th>
                            <td><a href="mailto:{{$customer->mail}}">{{$customer->mail}}</a></td>
                            <td>{{$customer->rate_per_hour}}€</td>
                            <td> N.A. €</td>
                            <td>N.A. €</td>
                            <td>N.A. €</td>
                            <td class="options"><div class="btn-group" role="group" aria-label="{{_('Customer Options')}}">
                                <a type="button" class="btn btn-primary" href="{{route('customer.edit', $customer->id)}}">Edit</a>
                                </div></td>
                        </tr>
                        </div>
                        @endforeach
                    </tbody>
                    </table>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
        </div>
    </div>
</div>
@endsection