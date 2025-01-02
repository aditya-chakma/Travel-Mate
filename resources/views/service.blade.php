@extends('layouts.app')

<?php 
$locations = DB::table('locations')->get();
?>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header"><h1><b>Add Service | {{Auth::user()->role }}</b></h1></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('add.service') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="cmpn_name" class="col-md-4 col-form-label text-md-right">{{ __('Service Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

                            <div class="col-md-6">
                                <input id="quantity" type="text" class="form-control" name="quantity" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cost" class="col-md-4 col-form-label text-md-right">{{ __('Cost') }}</label>

                            <div class="col-md-6">
                                <input id="cost" type="text" class="form-control" name="cost" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="discount" class="col-md-4 col-form-label text-md-right">{{ __('Discount') }}</label>

                            <div class="col-md-6">
                                <select id="discount" name="discount" class="form-control">
                                    <option value= "0">0%</option>
                                    <option value= "5">5%</option>
                                    <option value= "10">10%</option>
                                    <option value= "20">20%</option>
                                    <option value= "25">25%</option>
                                    <option value= "30">30%</option>
                                    <option value= "40">40%</option>
                                    <option value= "60">60%</option>
                                    <option value= "75">75%</option>
                                    <option value= "80">80%</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="service_type" class="col-md-4 col-form-label text-md-right">{{ __('Service Type') }}</label>

                            <div class="col-md-6">
                                <select id="service_type" name="service_type" class="form-control">
                                    <option value= "none">--none--</option>    
                                    <option value= "Room Rent">Room Rent</option>
                                    <option value= "Jeep Rent">Jeep Rent</option>
                                    <option value= "Guide Service">Guide Service</option>
                                    <option value= "Room & Jeep">Room & Jeep</option>
                                    <option value= "All">All</option>
                                    
                                    
                                </select>
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
