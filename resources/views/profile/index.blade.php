@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header h1">{{ __('Deine Geschäftsinformationen') }}</div>
                        
                <div class="card-body row">
                <div class="col-md-12">
                @if (Auth::user()->profile)
                   <form class="row" method="POST" enctype="multipart/form-data" action="{{ route('profile.update', Auth::user()->profile->id ) }}">
                   @method('PATCH')
                @else
                    <form class="row" method="POST" enctype="multipart/form-data" action="{{ route('profile.store') }}">
                @endif
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label">{{ __('Dein Unternehmensname') }}</label>
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name') ?? Auth::user()->profile->name ?? '' }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="street" class="col-md-12 col-form-label">{{ __('Straße') }}</label>
                                <div class="col-md-12">
                                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{old('street') ?? Auth::user()->profile->street ?? '' }}" autocomplete="street" autofocus required>

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
                                            <input id="zip" type="text" class="form-control @error('zip') is-invalid @enderror" name="zip" value="{{old('zip') ?? Auth::user()->profile->zip ?? '' }}" autocomplete="zip" autofocus required>

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
                                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{old('city') ?? Auth::user()->profile->city ?? '' }}" autocomplete="city" autofocus required>

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
                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{old('country') ?? Auth::user()->profile->country ?? '' }}" autocomplete="country" autofocus required>

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                        </div>

                        <div class="form-group row">
                            <label for="mail" class="col-md-12 col-form-label">{{ __('E-Mailadresse') }}</label>
                            <div class="col-md-12">
                                <input id="mail" type="email" class="form-control @error('mail') is-invalid @enderror" name="mail" value="{{old('mail') ?? Auth::user()->profile->mail ?? '' }}" autocomplete="mail" autofocus required>

                                @error('mail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-12 col-form-label">{{ __('Telefonnummer') }}</label>
                            <div class="col-md-12">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone') ?? Auth::user()->profile->phone ?? '' }}" autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                        </div>

                        <div class="form-group row">
                            <label for="url" class="col-md-12 col-form-label">{{ __('Webseite') }}</label>
                            <div class="col-md-12">
                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{old('url') ?? Auth::user()->profile->url ?? '' }}" autocomplete="url" autofocus>

                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                        </div>

                        </div>
                        <div class="col-md-6">
                        
                        
                        <div class="form-group row">
                            <label for="tax_id" class="col-md-12 col-form-label">{{ __('Umsatzsteuer ID') }}</label>
                            <div class="col-md-12">
                                <input id="tax_id" type="text" class="form-control @error('tax_id') is-invalid @enderror" name="tax_id" value="{{old('tax_id') ?? Auth::user()->profile->tax_id ?? '' }}" autocomplete="tax_id" autofocus>

                                @error('tax_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="invoice_counter" class="col-md-12 col-form-label">{{ __('Beginnende Rechnungsnummer') }}</label>
                            <div class="col-md-12">
                                <input id="invoice_counter" type="number" class="form-control @error('invoice_counter') is-invalid @enderror" name="invoice_counter" value="{{old('invoice_counter') ?? Auth::user()->profile->invoice_counter ?? '' }}" autocomplete="invoice_counter" autofocus>

                                @error('invoice_counter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="iban" class="col-md-12 col-form-label">{{ __('IBAN') }}</label>
                            <div class="col-md-12">
                                <input id="iban" type="text" class="form-control @error('iban') is-invalid @enderror" name="iban" value="{{old('iban') ?? Auth::user()->profile->iban ?? '' }}" autocomplete="iban" autofocus>

                                @error('iban')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bic" class="col-md-12 col-form-label">{{ __('BIC') }}</label>
                            <div class="col-md-12">
                                <input id="bic" type="text" class="form-control @error('bic') is-invalid @enderror" name="bic" value="{{old('bic') ?? Auth::user()->profile->bic ?? '' }}" autocomplete="bic" autofocus>

                                @error('bic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>    
                        

                        <div class="form-group row">
                            <label for="bank" class="col-md-12 col-form-label">{{ __('Bank') }}</label>
                            <div class="col-md-12">
                                <input id="bank" type="text" class="form-control @error('bank') is-invalid @enderror" name="bank" value="{{old('bank') ?? Auth::user()->profile->bank ?? '' }}" autocomplete="bank" autofocus>

                                @error('bank')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rate_per_hour_default" class="col-md-12 col-form-label">{{ __('Stundensatz') }}</label>
                            <div class="col-md-12">
                                <input id="rate_per_hour_default" type="number" min="0" max="10000" step="0.01" class="form-control @error('rate_per_hour_default') is-invalid @enderror" name="rate_per_hour_default" value="{{old('rate_per_hour_default') ??  Auth::user()->profile->rate_per_hour_default ?? '' }}" autocomplete="rate_per_hour_default" autofocus>

                                @error('rate_per_hour_default')
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
                                        {{ __('Einstellungen speichern') }}
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
