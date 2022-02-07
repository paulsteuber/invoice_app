@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>{{ __('Alle Kunden') }}</h1>
                    <a type="button" class="h3 btn btn-primary" href="{{ route('customer.create')}}">+ {{ __('Neuen Kunden erstellen') }}</a>
                </div>

                <div class="card-body row">
                   <div class="col-md-12">
                   <table class="table table-striped">
                   <thead>
                        <tr>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('E-Mailadresse') }}</th>
                            <th scope="col">{{ __('Stundensatz') }}</th>
                            <th scope="col">{{ __('Offen') }}</th>
                            <th scope="col">{{ __('Bezahlt') }}</th>
                            <th scope="col">{{ __('Gesamt') }}</th>
                            <th scope="col">{{ __('Aktionen') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->customers as $customer)
                        <tr>
                            <th scope="row">{{$customer->name}}  @if($customer->alias_name)({{$customer->alias_name}})@endif</th>
                            <td><a href="mailto:{{$customer->mail}}">{{$customer->mail}}</a></td>
                            <td>{{$customer->rate_per_hour}}€</td>
                            <td>{{ __('N.A. €') }}</td>
                            <td>{{ __('N.A. €') }}</td>
                            <td>{{ __('N.A. €') }}</td>
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