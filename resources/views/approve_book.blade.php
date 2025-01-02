@extends('layouts.app')

<?php
$services = DB::table('provided_service')->where('auth_id',Auth::user()->id)->get();


?>

@section('content')
<div class="container">
        <div class="row justify-content-center">
        <div class= "col-md-11">
        <div class="card">
            <div class="card-header"><h3>Booked Services</h3></div>

            <div class="card-body">
            @foreach($services as $service)
                <?php
                    $bookings = DB::table('bookings')->where('prvds_id',$service->prvds_id)->get();
                    

                    //$total = $total + ($service->cost * (1 - $service->discount/100.0));
                ?>

                @foreach($bookings as $booking)
                <?php
                    $location = DB::table('locations')->where('location_id',$service->location_id)->first();
                    $provider = DB::table('customers')->where('auth_id',$booking->auth_id)->first();
                    //here provider is actually customer
                ?>
                    <hr>
                    <div class="row no-gutters">
                            <div class="col-auto" >
                                <img src="{{asset('images/'.$service->file_name)}}" class="img-fluid" alt="" width="400" height="400">
                            </div>
                            <div class="col">
                                <div class="card-block px-2 p-3">
                                    
                                    <h3 class="card-title">{{ $service->name }}</h3>
                                    <h5>{{ $booking->service_date }}</h5>
                                    <h6><i> {{ $location->city }},{{ $location->district }},{{ $location->location }}</i></h6>
                                    <p class="card-text "><b>Cost : </b><span class="checkedr">{{ $service->cost }} $ </span><span  class=".checkedg">[{{ $service->discount }} % off] </span></p>
                                    <p class="card-text"><b>Customers Info : </b>{{ $provider->name }}, Email:{{ $provider->email }}, Contact No:{{ $provider->contact_number }}</p>
                                    <div class="btn-group">
                                                
                                        <form id="booking" action="{{ url('cancel_booking') }}" method="GET">
                                            @csrf
                                            <input type="hidden" name="booking_id" value="<?php echo $booking->booking_id; ?>"/>
                                            
                                            <button type="submit" class="btn btn-danger" >
                                                {{ __('CheckOut') }}
                                            </button>
                                        </form>
                                    
                                    </div>
                                

                                    
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endforeach
            @endforeach

            <hr>
            
            </div>
        </div>
        <br>
        <br>
        <div class="card">
        <div class="card-body">
            <h6>&copy 2019 All rights reserved
                <span class = "pull-right"> | Developed by Rouf,Aditya & Shabuj</span>
            </h6>
        </div>
        </div>
        </div>
        
@endsection
