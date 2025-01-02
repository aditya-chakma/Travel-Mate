@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Update Profile | {{Auth::user()->role }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update.profile') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="contact_number" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="contact_number" type="text" class="form-control" name="contact_number" placeholder="015 XX XX XX XX" required autocomplete="contact_number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Upload Photo') }}</label>

                            <div class="col-md-6">
                                <input  id="image" name="image" type="file" class="form-control-file">
                            </div>
                        </div>


                        @if(Auth::user()->role!='customer' && Auth::user()->role!='admin')
                        <div class="form-group row">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="birth_date" type="date" class="form-control" name="birth_date" required autocomplete="birth_date">
                            </div>
                        </div>

                            @if(Auth::user()->role == 'service_provider')
                                <div class="form-group row">
                                    <label for="roll" id= "roll" name="roll" class="col-md-4 col-form-label text-md-right">{{ __('Select Your Role') }}</label>

                                    <div class="col-md-6">
                                        <select id="roll" name="roll" class="form-control">
                                            <option value= "1">Hotel Manager</option>
                                            <option value= "2">Tour Guide</option>
                                            <option value="3">Driver</option>
                                        </select>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <label for="join_date" class="col-md-4 col-form-label text-md-right">{{ __('Joining Date') }}</label>

                                    <div class="col-md-6">
                                        <input id="join_date" type="date" class="form-control" name="join_date" required autocomplete="join_date">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="roll" id= "roll" name="roll" class="col-md-4 col-form-label text-md-right">{{ __('Select Your Role') }}</label>

                                    <div class="col-md-6">
                                        <select id="roll" name="roll" class="form-control">
                                            <option value= "4">Customer Service Officer</option>
                                            <option value= "5">Marketing Officer</option>
                                            <option value="6">Advisor</option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                        
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" placeholder="Home#01,Block#01,Section#01,Dhaka-1216" required autocomplete="address">
                            </div>
                        </div>

                        
                       

                        @endif

                        


                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
