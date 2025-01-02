@extends('layouts.app')
<?php 
    $employee = DB::table('employees')->where('auth_id',Auth::user()->id)->first();
    $service_provider = DB::table('service_providers')->where('auth_id',Auth::user()->id)->first();
    $customer = DB::table('customers')->where('auth_id',Auth::user()->id)->first();
    $user = DB::table('users')->where('id',Auth::user()->id)->first();
    //echo $customer;
    
?>
@section('content')
<div class="container">
        <div class="row justify-content-center">
        <div class= "col-md-11">
        <div class="card">
            <div class="card-header">Profile Page</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="alert alert-success"> Welcome <b>{{ Auth::user()->name }}</b> ! You are in your profile!</div>
               

                
            </div>

        </div>
        <br>
        <br>
        <div class="card">
            <div class="card-header"><h1><b>Profile</b></h1></div>
            
            <div class ='container margin-top-20'>
                <div class="row">
                        
                        <div class="card">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <img  src="{{asset('images/'.Auth::user()->file_name)}}" class="img-fluid" alt="Hello" width="350" height="600">
                                    </div>

                                    @if(Auth::user()->role == 'admin')
                                        <div class="col">
                                            <div class="card-block px-2">
                                                <h1 class="card-title"><b>{{Auth::user()->name}}</b></h1>
                                                <p class="card-text">Age    : 25</p>
                                                <p class="card-text">Email  : {{Auth::user()->email}}</p>
                                                <p class="card-text">Contact: 01515269628 </p>
                                                <p class="card-text">Address: Mirpur-10,Dhaka</p>
                                            </div>
                                        </div>
                                    @elseif(Auth::user()->role == 'customer')
                                        <div class="col">
                                                <div class="card-block px-2">
                                                    <h1 class="card-title"><b>{{Auth::user()->name}}</b></h1>
                                                    <p class="card-text">Age    : 25</p>
                                                    <p class="card-text">Email  : {{Auth::user()->email}}</p>
                                                    <p class="card-text">Contact: {{$customer->contact_number}} </p>
                                                    <p class="card-text">Address: Mirpur-10,Dhaka</p>
                                                    
                                                </div>
                                        </div>
                                    @elseif(Auth::user()->role == 'service_provider' && Auth::user()->enable_access)
                                        <div class="col">
                                                <div class="card-block px-2">
                                                    <h1 class="card-title"><b>{{Auth::user()->name}}</b></h1>
                                                    <p class="card-text">Date of Birth  : {{$service_provider->birth_date}}</p>
                                                    <p class="card-text">Email  : {{Auth::user()->email}}</p>
                                                    <p class="card-text">Contact: {{$service_provider->contact_number}}</p>
                                                    <p class="card-text">Address: {{$service_provider->address}}</p>
                                                    
                                                </div>
                                        </div>

                                    @elseif(Auth::user()->role == 'employee' && Auth::user()->enable_access)

                                        <div class="card-block px-2">
                                            <h1 class="card-title"><b>{{Auth::user()->name}}</b></h1>
                                            <p class="card-text">Date of Birth  : {{$employee->birth_date}}</p>
                                            <p class="card-text">Joining date  : {{$employee->join_date}}</p>
                                            <p class="card-text">Email  : {{Auth::user()->email}}</p>
                                            <p class="card-text">Contact: {{$employee->contact_number}}</p>
                                            <p class="card-text">Address: {{$employee->address}}</p>
                                            
                                        </div>

                                    @endif
                                </div>
                            </div>
                    </div>

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
        <div >
</div>

@endsection
