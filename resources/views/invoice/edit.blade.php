@extends('layouts.app')

@section('content')
<div class="container-fluid invoice-create">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="h6 fw-bolder">{{ __('Rechnung bearbeiten') }}</h3>
                </div>
                <div class="card-body row">
                   <div class="col-md-12">
                       @if ($user->profile)
                       
                   <form method="POST" enctype="multipart/form-data" action="{{ route('invoice.update', $invoice->id), }}">
                        @csrf
                        @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow customer-card mb-3">
                                <div class="card-header">
                                @if($errors->any())
                                    {{ implode('', $errors->all('<div>:message</div>')) }}
                                @endif
                                    <h5 class="h6 fw-bolder mb-0">{{__('Kundeninformationen')}}</h5>
                                </div>
                                <div class="card-body row">
                                <customer-component old-invoice-id="{{$invoice->id}}"></customer-component>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow your-card mb-3">
                                <div class="card-header">
                                    <h5 class="h6 fw-bolder mb-0">{{__('Deine Kontaktinformationen')}}</h5>
                                </div>
                                <div class="card-body row">
                                <div class="col-lg-6">
                                    <div class="row">         
                                        <div class="form-group col-md-12">
                                            <div class="row">
                                                <label for="name" class="col-md-12 col-form-label">{{ __('Name') }}</label>
                                                <div class="col-md-12">
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$invoice->name}}" required >
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="row">
                                                <label for="street" class="col-md-12 col-form-label">{{ __('Straße') }}</label>
                                                <div class="col-md-12">
                                                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{$invoice->street}}" required >
                                                    @error('street')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group col-lg-6">
                                            <div class="row">
                                                <label for="zip" class="col-md-12 col-form-label">{{ __('PLZ') }}</label>
                                                <div class="col-md-12">
                                                    <input id="zip" type="text" class="form-control @error('zip') is-invalid @enderror" name="zip" value="{{$user->profile->zip}}" required >
                                                    @error('zip')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <div class="row">
                                                <label for="city" class="col-md-12 col-form-label">{{ __('City') }}</label>
                                                <div class="col-md-12">
                                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{$user->profile->city}}" required >
                                                    @error('city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <div class="row">
                                                <label for="mail" class="col-md-12 col-form-label">{{ __('Mail') }}</label>
                                                <div class="col-md-12">
                                                    <input id="mail" type="text" class="form-control @error('city') is-invalid @enderror" name="mail" value="{{$user->profile->mail}}" required >
                                                    @error('mail')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="row">
                                                <label for="url" class="col-md-12 col-form-label">{{ __('Webseite') }}</label>
                                                <div class="col-md-12">
                                                    <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{$user->profile->url}}" required >
                                                    @error('mail')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                        <div class="col-md-6">
                                <div class="form-group col-md-12">
                                        <div class="row">
                                            <label for="phone" class="col-md-12 col-form-label">{{ __('Telefonnummer') }}</label>
                                            <div class="col-md-12">
                                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$user->profile->phone}}">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                <div class="form-group col-md-12">
                                    <div class="row">
                                        <label for="iban" class="col-md-12 col-form-label">{{ __('IBAN') }}</label>
                                        <div class="col-md-12">
                                            <input id="iban" type="text" class="form-control @error('iban') is-invalid @enderror" name="iban" value="{{$user->profile->iban}}" required >
                                            @error('iban')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="row">
                                        <label for="bic" class="col-md-12 col-form-label">{{ __('BIC') }}</label>
                                        <div class="col-md-12">
                                            <input id="bic" type="text" class="form-control @error('bic') is-invalid @enderror" name="bic" value="{{$user->profile->bic}}" required >
                                            @error('bic')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="row">
                                        <label for="bank" class="col-md-12 col-form-label">{{ __('Bank') }}</label>
                                        <div class="col-md-12">
                                            <input id="bank" type="text" class="form-control @error('bank') is-invalid @enderror" name="bank" value="{{$invoice->bank}}" required >
                                            @error('bank')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="row">
                                        <label for="bank" class="col-md-12 col-form-label">{{ __('Umsatzsteuer ID') }}</label>
                                        <div class="col-md-12">
                                            <input id="tax_id" type="text" class="form-control @error('tax_id') is-invalid @enderror" name="tax_id" value="{{$invoice->tax_id}}" >
                                            @error('tax_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                              </div>  
                        </div>
                    </div>
                    </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="card invoice-card shadow">
                                    <div class="card-header">
                                        <h2 class="h6 fw-bolder mb-0">{{__('Rechnungseinstellungen')}}</h2>
                                    </div>
                                    <div class="card-body row">
                                       <invoice-number-component next-invoice-number="{{$invoice->invoice_number}}" all-invoice-numbers="{{$user->invoice_numbers()}}"></invoice-number-component> 

                                        <div class="form-group col-lg-6">
                                            <div class="row">
                                                <label for="invoice_description" class="col-md-12 col-form-label">{{ __('Beschreibung') }}</label>
                                                <div class="col-md-12">
                                                    <input id="invoice_description" type="text" class="form-control @error('invoice_description') is-invalid @enderror" name="invoice_description" placeholder="" required autocomplete="invoice_description" value="{{$invoice->invoice_description}}">

                                                    @error('invoice_description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-2">
                                            <div class="row">
                                                <label for="invoice_date" class="col-md-12 col-form-label">{{ __('Rechnungsdatum') }}</label>
                                                <div class="col-md-12">
                                                <invoice-date-picker input-classes="form-control @error('invoice_date') is-invalid @enderror" placeholder="{{$invoice->invoice_date  ?? date('Y-m-d') }}" date="{{ $invoice->invoice_date  ?? date('Y-m-d') }}"></invoice-date-picker>
                                                    @error('invoice_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="card position-list-card shadow">
                                    <div class="card-header">
                                        <h2 class="h6 fw-bolder mb-0">{{__('Rechnungspositionen')}}</h2>
                                    </div>
                                    <div class="card-body row">
                                        <invoice-parent-position-component old-positions="{{$invoice->all_positions}}"></invoice-parent-position-component>
                                      <!--<invoice-position-component old-positions="{{$invoice->all_positions}}"></invoice-position-component> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="card additional-information shadow">
                                    <div class="card-header"><h2 class="h6 fw-bolder mb-0">{{__('Zahlungsinformationen')}}</h2></div>
                                        <div class="card-body row form-group">
                                            <div class="col-lg-5">
                                            @error('invoice_partial_pay', 'invoice_partial_pay_date', 'invoice_partial_pay_sum', 'invoice_pay_date', 'invoice_state', 'invoice_additional')
                                                        <span class="invalid-feedback" role="alert">
                                                        <h1>HUHU</h1>
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                <!--  -->
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="invoice_pay_date" class="col-form-label">{{ __('Gesamt Zahlungsziel') }}</label>
                                                            <invoice-pay-date-picker input-classes="form-control @error('invoice_pay_date') is-invalid @enderror" date="{{ $invoice->invoice_pay_date }}"></invoice-pay-date-picker>
                                                            @error('invoice_pay_date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <label for="invoice_state" class=" col-form-label">{{ __('Status') }}</label>
                                                        <select class="custom-select" id="invoice_state" name="invoice_state" required value="{{$invoice->invoice_state}}">
                                                            <option selected value="draft">Entwurf</option>
                                                            <option value="open">Offen</option>
                                                            <option value="paid">Beglichen</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>                                        
                                            <div class="col-lg-7">
                                                <label for="invoice_additional" class="col-md-12 col-form-label">{{ __('Ergänzende Anmerkung') }}</label>
                                                <div class="col-md-12">
                                                    <textarea id="invoice_additional" class="form-control @error('invoice_additional') is-invalid @enderror" name="invoice_additional" value="{{ $invoice->invoice_additional }}" placeholder="{{'Weitere Informationen zu dieser Rechnung (z.B. Teilvorauszahlung)'}}"></textarea>

                                                    @error('invoice_additional')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-6 d-flex justify-content-end">
                                    <div class="row">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Rechnung speichern') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </form>
                    
                   @else
                   <p class="text-center">Bevor du eine Rechnung anlegen kannst,<br> musst du dein <a href="{{route('profile')}}">Profil bearbeiten</a>.</p>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection