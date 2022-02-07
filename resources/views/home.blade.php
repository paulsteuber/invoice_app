@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Du bist eingeloggt!') }}

                    <div class="row">                      
                        <div class="col-md-12">
                            {{$user}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
