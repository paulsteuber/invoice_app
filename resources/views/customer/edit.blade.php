@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>{{ __('Edit Customer') }}</h1>
                </div>
                <div class="card-body row">
                   <div class="col-md-12">
                   <form class="row" method="POST" enctype="multipart/form-data" action="{{ route('customer.update', $customer->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label">{{ __('Kundenname') }}</label>
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $customer->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alias_name" class="col-md-12 col-form-label">{{ __('Alias Name') }}</label>
                                <div class="col-md-12">
                                    <input id="alias_name" type="text" class="form-control @error('alias_name') is-invalid @enderror" name="alias_name" value="{{ $customer->alias_name }}" autocomplete="alias_name" autofocus>

                                    @error('alias_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="street" class="col-md-12 col-form-label">{{ __('Straße') }}</label>
                                <div class="col-md-12">
                                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ $customer->street }}" autocomplete="street" autofocus required>

                                    @error('street')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">       
                                    <div class="form-group row">
                                        <label for="zip" class="col-md-12 col-form-label">{{ __('PLZ') }}</label>
                                        <div class="col-md-12">
                                            <input id="zip" type="text" class="form-control @error('zip') is-invalid @enderror" name="zip" value="{{ $customer->zip }}" autocomplete="zip" autofocus required>

                                            @error('zip')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                            <label for="city" class="col-md-12 col-form-label">{{ __('Stadt') }}</label>
                                            <div class="col-md-12">
                                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $customer->city }}" autocomplete="city" autofocus required>

                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                    </div>
                                </div>
                            </div>
                            
                        <div class="form-group row">
                            <label for="country" class="col-md-12 col-form-label">{{ __('Land') }}</label>
                            <div class="col-md-12">
                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ $customer->country}}" autocomplete="country" autofocus required>

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                        </div>
                        </div>
                        <div class="col-md-6">
                        
                            
                        <div class="form-group row">
                            <label for="mail" class="col-md-12 col-form-label">{{ __('E-Mailadresse') }}</label>
                            <div class="col-md-12">
                                <input id="mail" type="email" class="form-control @error('mail') is-invalid @enderror" name="mail" value="{{ $customer->mail }}" autocomplete="mail" autofocus required>

                                @error('mail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="website" class="col-md-12 col-form-label">{{ __('Webseite') }}</label>
                            <div class="col-md-12">
                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ $customer->website }}" autocomplete="website" autofocus>

                                @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-12 col-form-label">{{ __('Telefonnummer') }}</label>
                            <div class="col-md-12">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $customer->phone }}" autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                           
                            
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-6 d-flex justify-content-end">
                                    <a href="{{route('customers')}}" class="btn btn-outline-secondary mr-2">
                                        {{ __("Abbrechen") }}
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Speichern') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        
                    </form>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
        </div>
    </div>
</div>
@endsection