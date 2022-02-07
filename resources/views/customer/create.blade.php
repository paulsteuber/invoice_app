@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>{{ __('Neuen Kunden erstellen') }}</h1>
                </div>

                <div class="card-body row">
                   <div class="col-md-12">
                   <form class="row" method="POST" enctype="multipart/form-data" action="{{ route('customer.store') }}">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label">{{ __('Kundenname / Unternehmensname') }}</label>
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                    <input id="alias_name" type="text" class="form-control @error('alias_name') is-invalid @enderror" name="alias_name" value="{{ old('alias_name') }}" autocomplete="alias_name" autofocus>

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
                                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" autocomplete="street" autofocus required>

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
                                            <label for="city" class="col-md-12 col-form-label">{{ __('Stadt') }}</label>
                                            <div class="col-md-12">
                                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" autocomplete="city" autofocus required>

                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-6">       
                                    <div class="form-group row">
                                        <label for="zip" class="col-md-12 col-form-label">{{ __('PLZ') }}</label>
                                        <div class="col-md-12">
                                            <input id="zip" type="text" class="form-control @error('zip') is-invalid @enderror" name="zip" value="{{ old('zip') }}" autocomplete="zip" autofocus required>

                                            @error('zip')
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
                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" autocomplete="country" autofocus >

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
                                <input id="mail" type="email" class="form-control @error('mail') is-invalid @enderror" name="mail" value="{{ old('mail') }}" autocomplete="mail" autofocus required>

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
                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" autocomplete="website" autofocus>

                                @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                        </div>

                        <div class="form-group row">
                            <label for="tax_id" class="col-md-12 col-form-label">{{ __('Steuernumer') }}</label>
                            <div class="col-md-12">
                                <input id="tax_id" type="text" class="form-control @error('tax_id') is-invalid @enderror" name="tax_id" value="{{ old('tax_id') }}" autocomplete="tax_id" autofocus>

                                @error('tax_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rate_per_hour" class="col-md-12 col-form-label">{{ __('Stundensatz') }}</label>
                            <div class="col-md-12">
                                <input id="rate_per_hour" type="text" class="form-control @error('rate_per_hour') is-invalid @enderror" name="rate_per_hour" value="{{ old('rate_per_hour') }}" autocomplete="rate_per_hour" autofocus>

                                @error('rate_per_hour')
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
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Kunden speichern') }}
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