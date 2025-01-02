@extends('layouts.app')

<?php 
$locations = DB::table('locations')->get();
?>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header"><h1><b>Add Company Details | {{Auth::user()->role }}</b></h1></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('add.company') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="cmpn_name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>

                            <div class="col-md-6">
                                <input id="cmpn_name" type="text" class="form-control" name="cmpn_name" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="e_mail" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="e_mail" type="text" class="form-control" name="e_mail" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" placeholder="Road-Block-House no" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="locations" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                            <div class="col-md-6">
                                <select id="location_id" name="location_id" class="form-control">
                                   @foreach( $locations as $location ) 
                                    <option value= "{{ $location->location_id }}">City:{{ $location->city }} | District:{{ $location->district }} | Location:{{ $location->location }} </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact_number" class="col-md-4 col-form-label text-md-right">{{ __('Helpline') }}</label>

                            <div class="col-md-6">
                                <input id="contact_number" type="text" class="form-control" name="contact_number" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Upload Photo') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control-file" name="image" autofocus>
                            </div>
                        </div>
       
                        

                        


                        

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
