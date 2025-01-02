@extends('layouts.app')

<?php
use Illuminate\Support\Facades\Auth;
use Psy\Command\WhereamiCommand;

$employees = DB::table('employees')->get();
$service_providers = DB::table('service_providers')->get();

$count = DB::table('customers')->where('auth_id',Auth::user()->id)->count();

if($count == 0 && Auth::user()->role == 'customer'){
    
    DB::table('customers')->insert([
        'name' => Auth::user()->name ,
        'email' => Auth::user()->email ,
        'contact_number' => '015XXXXXXXX',
        'auth_id' => Auth::user()->id,
        ]);
        
}

$companyupdate = DB::table('company')->where('auth_id',Auth::user()->id)->first();

?>

@section('content')
<div class="container">
        <div class="row justify-content-center">
        <div class= "col-md-11">
        <div class="card">
            <div class="card-header">Login Status | <h1><b>{{Auth::user()->role}}</b></h1></div>

            <div class="card-body">
                
                @if (session('status') != null)
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if(session('success')!=null)
                <hr>
                <div class="alert alert-success"> {{session('success')}} </div>
                <hr>
                @endif

                @if(Auth::user()->role == 'customer')
                 
                    <h4><b>Filtered By</b></h4>
                
                    <form action="{{ url('/filter_now') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="book_date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                        <div class="col-md-6">
                            <input id="date" type="date" class="form-control" name="service_date" autofocus>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="price_range" class="col-md-4 col-form-label text-md-right">{{ __('Price Range') }}</label>

                        <div class="col-md-6">
                        <input type="number" class="form-control" name="price_range" placeholder="$">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                        <div class="col-md-6">
                        <select type="text" class="form-control" name="location_id">
                            <?php $allLocations = DB::table('locations')->get()?>
                            @foreach($allLocations as $l)
                                <option value="{{ $l->location_id }}">{{ $l->location }},{{ $l->district }},{{ $l->city }}</option>
                            @endforeach
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
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-default btn-block">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </form>
                </div>
                
                                
                                
                @endif
                
                
                @if((Auth::user()->role == 'employee' || Auth::user()->role == 'service_provider')&& Auth::user()->enable_access == false)
                <div class="alert alert-danger"> 
                    You have to wait for admins approval otherwise you can't see your profile.<br>
                    <b>Note : </b>It is good practise to fillup all info which helps admin for selection!<br>
                    Go to <b>{{Auth::user()->name}} > Update Profile<b>

                </div>

                @endif
                
                

                @if((Auth::user()->role == 'employee' || Auth::user()->role == 'admin')&& Auth::user()->enable_access && session('message') !=null)
                    <div class="alert alert-info"> 
                        {{session('message')}}

                    </div>  
                @endif

                @if(Auth::user()->role == 'admin')
                    <h3> Report Generation </h3>
                    <form action="{{ url('/report') }}" method="GET">
                        @csrf
                        <div class="form-group row">
                            <label for="report_type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <select id="type" name="type" class="form-control">
                                    <option value= "1">Booking In ToDay</option>
                                    <option value= "2">Booking In Next Day</option>
                                    <option value= "3">Booking In this Month</option>
                                    <option value= "4">Booking Upto Next Month</option>
                                    <option value= "5">Booking In This Year</option>
                                    <option value= "6">Booked Services</option>
                                    <option value= "7">Pending Service Providers</option>
                                    <option value= "8">Pending Service Employees</option>
                                    <option value= "9">Pending Services</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-warning btn-block">
                                    {{ __('Generate') }}
                                </button>
                            </div>
                        </div>
                    </form>
                @endif

                
            </div>

        </div>
        <br>
        <br>
        @if(Auth::user()->enable_access)
            <div class="col-sm-15">
                @if(Auth::user()->role != 'customer' && Auth::user()->role != 'service_provider')
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'employee')
                            @if(Auth::user()->role == 'admin')
                                <?php $alreadyapproved = false;?>
                                <h3><b>Pending Request List</b></h3>
                                <hr>
                                <div class="widget">
                                    <div class="row">
                                        @foreach($employees as $user)
                                            <?php 
                                                $row = DB::table('users')->where('id', $user->auth_id)->first();
                                                if($row != null ) $alreadyapproved = $row->enable_access;
                                            
                                            ?>
                                            @if(!$alreadyapproved)

                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <img class="card-img-top feature-img" src="{{asset('images/'.$row->file_name)}}" alt="Card image" width="400" height="200">
                                                        <div class="card-body">
                                                            <b><h4 class="card-title">{{ $user->name }} </h4></b>
                                                            <p class="card-text"><b>Job Designation : </b> Employee </p>
                                                            <p class="card-text"><b>Joining-Date : </b>{{ $user->join_date }}</p>
                                                            <p class="card-text"><b>Birth-Date : </b>{{ $user->birth_date }}</p>
                                                            <p class="card-text"><b>Contact Number : </b>{{ $user->contact_number }}</p>
                                                            <p class="card-text"><b>Email :</b> {{$user->email}}</p>
                                                            <p class="card-text"><b>Address :</b> {{$user->address}}</p>
                                                            <div>
                                                                <form id="approve" action="{{  url('/approve') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="<?php echo $user->auth_id; ?>"/>
                                                                    <button type="submit" class="btn btn-success btn-lg btn-block" >
                                                                        {{ __('Accept Request') }}
                                                                    </button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                </div>
                            </div>

                            @elseif(Auth::user()->role == 'employee')
                                <?php $alreadyapproved = false;?>
                                <h3><b>Pending Request List</b></h3>
                                <hr>
                                <div class="widget">
                                    <div class="row">
                                        @foreach ($service_providers as $user)
                                            <?php 
                                                    $row = DB::table('users')->where('id', $user->auth_id)->first();
                                                    if($row != null ) $alreadyapproved = $row->enable_access;
                                                
                                            ?>
                                        @if(!$alreadyapproved)
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <img class="card-img-top feature-img" src="{{asset('images/'.$row->file_name)}}" alt="Card image" width="400" height="200">
                                                    <div class="card-body">
                                                        <h4 class="card-title"><b>{{ $user->name }} </b></h4>
                                                        <p class="card-text"><b>Job Designation : </b> Service Provider </p>
                                                        <p class="card-text"><b>Birth-Date : </b>{{ $user->birth_date }}</p>
                                                        <p class="card-text"><b>Contact Number : </b>{{ $user->contact_number }}</p>
                                                        <p class="card-text"><b>Email :</b> {{$user->email}}</p>
                                                        <p class="card-text"><b>Address :</b> {{$user->address}}</p>
                                                        <div>
                                                            <form id="approve" action="{{  url('/approve') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id" value="<?php echo $user->auth_id; ?>"/>
                                                                <button type="submit" class="btn btn-success btn-lg btn-block" >
                                                                    {{ __('Approve Providers') }}
                                                                </button>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @endforeach
                                        </div>
                                    </div>
                                    <hr>
                                    <h3><b>Pending Services List</b></h3>
                                    <hr>
                                    <div class="widget">
                                        <div class="row">
                                            <?php 
                                                $services = DB::table('provided_service')->get();
                                                $counts = DB::table('provided_service')->count();
                                            ?>
                                                
                                                @foreach($services as $service)
                                                    @if($service->service_enable_bit == 0)
                                                    <?php 
                                                    
                                                    $location = DB::table('locations')->where('location_id',$service->location_id)->first();
                                                    $service_provider_info = DB::table('service_providers')->where('auth_id',$service->auth_id)->first();
                                                    ?>
                                                    <div class="col-md-4">
                                                    <div class="card">
                                                        <img class="card-img-top feature-img" src="{{asset('images/'.$service->file_name)}}" alt="Card image" width="400" height="200">
                                                        <div class="card-body">
                                                            <h4 class="card-title">{{ $service->name }}</h4>
                                                            <p class="card-text"><b>Service Description : </b>{{ $service->description }}</p>
                                                            <p class="card-text"><b>Service Cost : </b>{{ $service->cost }} $</p>
                                                            <p class="card-text"><b>Discount : </b>{{ $service->discount }} %</p>
                                                            <p class="card-text"><b>Service Type : </b>{{ $service->service_type }}</p>
                                                            <hr>
                                                            <p class="card-text"><b>Provider's Name : </b>{{ $service_provider_info->name }}</p>
                                                            <p class="card-text"><b>Contact Number : </b>{{ $service_provider_info->contact_number }}</p>
                                                            <p class="card-text"><b>Provider's Email : </b>{{ $service_provider_info->email }}</p>
                                                            <hr>
                                                            <p class="card-text"><b>Location : </b> City : {{ $location->city }} | Location : {{ $location->location }} </p>
                                                            <div>
                                                                <form id="delete" action="{{ url('/approve_service') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="<?php echo $service->prvds_id; ?>"/>
                                                                    
                                                                    <button type="submit" class="btn btn-success btn-lg btn-block" >
                                                                        {{ __('Approve Service') }}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <br>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endforeach
                                                
                                            </div>
                                        </div>
                            @endif
                    @endif
                    
            @endif
            </div>

                 @if(Auth::user()->role == 'service_provider' && $companyupdate != null)
                
                <h1><b>Company Details</b></h1>
                <hr>
                <div class="row no-gutters">
                    <div class="col-auto">
                        <img  src="{{asset('images/'.$companyupdate->file_name)}}" class="img-fluid" alt="Hello" width="500" height="200">
                    </div>
                    <div class="col">
                        <div class="card-block px-2">
                            <h1 class="card-title"><b>{{ $companyupdate->cmpn_name }}</b></h1>
                            <p class="card-text">Description    : {{ $companyupdate->description }}</p>
                            <p class="card-text">Email  : {{ $companyupdate->e_mail }}</p>
                            <p class="card-text">Address: {{ $companyupdate->address }} </p>
                            <p class="card-text">Helpline : {{ $companyupdate->contact_number }}</p>
                        </div>
                    </div>   
                </div>
                @endif
                @if(Auth::user()->role == 'service_provider')
                <hr>
                <div class="col-sm-15">
                  <h1><b>Added Services</b></h1>
                  <hr>
                  <div class="widget">
                        <div class="row">
                          <?php 
                            $services = DB::table('provided_service')->where("auth_id",Auth::user()->id)->get();
                            $counts = DB::table('provided_service')->where("auth_id",Auth::user()->id)->count();
                          ?>
                            @if($counts != 0)
                              @foreach($services as $service)
                                @if($service->service_enable_bit)
                                <?php 
                                  $location = DB::table('locations')->where('location_id',$service->location_id)->first();
                                ?>
                                <div class="col-md-4">
                                  <div class="card">
                                      <img class="card-img-top feature-img" src="{{asset('images/'.$service->file_name)}}" alt="Card image" width="400" height="200">
                                      <div class="card-body">
                                        <h4 class="card-title">{{ $service->name }}</h4>
                                        <p class="card-text"><b>Service Description : </b>{{ $service->description }}</p>
                                        <p class="card-text"><b>Service Cost : </b>{{ $service->cost }} $</p>
                                        <p class="card-text"><b>Discount : </b>{{ $service->discount }} %</p>
                                        <p class="card-text"><b>Service Type : </b>{{ $service->service_type }}</p>
                                        <p class="card-text"><b>Location : </b> City : {{ $location->city }} | Location : {{ $location->location }} </p>
                                        <div>
                                            <form id="delete" action="{{ url('/delete') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="<?php echo $service->prvds_id; ?>"/>
                                                
                                                <button type="submit" class="btn btn-danger btn-lg btn-block" >
                                                    {{ __('Delete service') }}
                                                </button>
                                            </form>
                                        </div>
                                        <br>
                                        <div>
                                            <form id="update" action="{{ url('/update_service') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="ser_id" value="<?php echo $service->prvds_id; ?>"/>
                                                
                                                <button type="submit" class="btn btn-primary btn-lg btn-block" >
                                                    {{ __('Update service') }}
                                                </button>
                                            </form>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                @endif
                              @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            @endif

            @if(Auth::user()->role == 'customer')
                <div class="col-sm-15">
                    
                    <div class="widget">
                            <hr>
                            <h4>Available Services</h4>
                                <div class="row">
                                <div class="col-md-4">
                                <form class="form-inline" id="searchCity" action="{{ url('/search_city') }}" method="POST">
                                    @csrf
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="city"  placeholder="City " aria-label="Search your">

                                            <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                                <i class="fa fa-search">
                                                {{ __('Search') }}
                                                </i></button>
                                            
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-4">
                                <form class="form-inline my-3 my-lg-1" id="rating" action="{{ url('/search_district') }}" method="POST">
                                 @csrf
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="district"  placeholder="District " aria-label="Search your">

                                        <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                            <i class="fa fa-search">
                                             {{ __('Search') }}
                                            </i></button>
                                        
                                        </div>
                                    </div>
                                </form>
                                </div>
                                
                                <div class="col-md-4">
                                <form class="form-inline my-3 my-lg-1" id="rating" action="{{ url('/search_location') }}" method="POST">
                                 @csrf
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="location"  placeholder="Location " aria-label="Search your">

                                        <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                            <i class="fa fa-search">
                                             {{ __('Search') }}
                                            </i></button>
                                        
                                        </div>
                                    </div>
                                </form>
                                </div>
                                </div>
                                <!-- JS section for searching -->
                                
                                <!-- end -->


                            <hr>
                            <h3>Recommended For You</h3>
                            <hr>
                            <div class="row">
                            
                            <?php 
                                $ratings = DB::table('rating')->where('auth_id',Auth::user()->id)->where('star', '>', 2 )
                                ->orderBy('star', 'desc')
                                ->get();

                                //echo $ratings;
                            ?>

                                @foreach($ratings as $rating)
                                    <?php 
                                    
                                        $service = DB::table('provided_service')->where('prvds_id',$rating->prvds_id)->first();
                                        $location = DB::table('locations')->where('location_id',$service->location_id)->first();
                                        $provider = DB::table('service_providers')->where('auth_id',$service->auth_id)->first();
                                    ?>
                                    @if($service->service_enable_bit)
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header"><h5 class="checkedb"><b>{{ $service->name }}</b></h5></div>
                                            <img class="card-img-top feature-img" src="{{asset('images/'.$service->file_name)}}" alt="Card image" width="400" height="200">
                                            <div class="card-body">
                                                <p class="card-text"> <b> Rating : </b>
                                            
                                                @if($rating->star == 5)
                                                    <span class="fa fa-star checkedr"></span> 
                                                    <span class="fa fa-star checkedr"></span> 
                                                    <span class="fa fa-star checkedr"></span> 
                                                    <span class="fa fa-star checkedr"></span> 
                                                    <span class="fa fa-star checkedr"></span>
                                                @elseif($rating->star == 4)
                                                    <span class="fa fa-star checkedo"></span> 
                                                    <span class="fa fa-star checkedo"></span> 
                                                    <span class="fa fa-star checkedo"></span> 
                                                    <span class="fa fa-star checkedo"></span>
                                                @elseif($rating->star == 3)
                                                    <span class="fa fa-star checkedy"></span> 
                                                    <span class="fa fa-star checkedy"></span> 
                                                    <span class="fa fa-star checkedy"></span>
                                                @elseif($rating->star == 2)
                                                    <span class="fa fa-star checkedg"></span> 
                                                    <span class="fa fa-star checkedg"></span>
                                                @elseif($rating->star == 1)
                                                    <span class="fa fa-star checkedb"></span>
                                                @else
                                                    <span class="checkedr">N/A</span>
                                                @endif
                                                </p>
                                                <p class="card-text "><b>Cost : </b><span class="checkedr">{{ $service->cost }} $ </span><span  class=".checkedg">[{{ $service->discount }} % off] </span></p>
                                                <p class="card-text">{{ $service->description }} <br>{{ $location->city }},{{ $location->district }},{{ $location->location }}</p>
                                                <p class="card-text"><b>Providers Info : </b>{{ $provider->name }}, Email:{{ $provider->email }}, Contact No:{{ $provider->contact_number }}</p>
                                                <div class="btn-group btn-group-justified">
                                                
                                                    <form id="booking" action="{{ url('/book_now') }}" method="GET">
                                                        @csrf
                                                        <input type="hidden" name="id" value="<?php echo $service->prvds_id; ?>"/>
                                                        
                                                        <button type="submit" class="btn btn-primary" >
                                                            {{ __('Book Now') }}
                                                        </button>
                                                    </form>
                                                
                                                
                                                    <form id="rating" action="{{ url('/rating') }}" method="GET">
                                                        @csrf
                                                        <input type="hidden" name="id" value="<?php echo $service->prvds_id; ?>"/>
                                                        
                                                        <button type="submit" class="btn btn-success" >
                                                            {{ __('Rate it') }}
                                                        </button>
                                                    </form>

                                                    <form id="rating" action="{{ url('/see_review') }}" method="GET">
                                                        @csrf
                                                        <input type="hidden" name="ser_id" value="<?php echo $service->prvds_id; ?>"/>
                                                        
                                                        <button type="submit" class="btn btn-warning" >
                                                            {{ __('See Review') }}
                                                        </button>
                                                    </form>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            <hr>
                            <h3><b>Available Services</b></h3>
                            <hr>
                            <div class="row">
                            <?php 
                                $services = DB::table('provided_service')->get();
                            ?>
                              @foreach($services as $service)
                              @if($service->service_enable_bit)
                                <?php 
                                  $location = DB::table('locations')->where('location_id',$service->location_id)->first();
                                  $provider = DB::table('service_providers')->where('auth_id',$service->auth_id)->first();
                                ?>
                                <div class="col-md-4">
                                  <div class="card">
                                      <div class="card-header"><h5 class="checkedb"><b>{{ $service->name }}</b></h5></div>
                                      <img class="card-img-top feature-img" src="{{asset('images/'.$service->file_name)}}" alt="Card image" width="400" height="200">
                                      <div class="card-body">
                                      
                                      <?php 
                                          $ratings = DB::table('rating')->where('prvds_id',$service->prvds_id)->get();
                                          $c = DB::table('rating')->where('prvds_id',$service->prvds_id)->count();
                                          $i = 0;
                                          $sum = 0;
                                          $lower = 0;
                                          $average = 0;
                                          if($c != 0){
                                            foreach($ratings as $rating)
                                            {
                                                $i = $i+1;
                                                $sum = $sum+$rating->star;
                                            }
  
                                            $average = $sum/$i;
                                            
                                            $lower = (int)$average;
                                          }
                                          $marginal = $lower + 0.5;
                                          if($average < $marginal)
                                          {
                                            $average = $lower;
                                          }
                                          else {
                                            $average = $lower + 1;
                                          }
                                        ?>
                                        <p class="card-text"> <b> Rating : </b>
                                       
                                          @if($average == 5)
                                            <span class="fa fa-star checkedr"></span> 
                                            <span class="fa fa-star checkedr"></span> 
                                            <span class="fa fa-star checkedr"></span> 
                                            <span class="fa fa-star checkedr"></span> 
                                            <span class="fa fa-star checkedr"></span>
                                          @elseif($average == 4)
                                            <span class="fa fa-star checkedo"></span> 
                                            <span class="fa fa-star checkedo"></span> 
                                            <span class="fa fa-star checkedo"></span> 
                                            <span class="fa fa-star checkedo"></span>
                                          @elseif($average == 3)
                                            <span class="fa fa-star checkedy"></span> 
                                            <span class="fa fa-star checkedy"></span> 
                                            <span class="fa fa-star checkedy"></span>
                                          @elseif($average == 2)
                                            <span class="fa fa-star checkedg"></span> 
                                            <span class="fa fa-star checkedg"></span>
                                          @elseif($average == 1)
                                            <span class="fa fa-star checkedb"></span>
                                          @else
                                            <span class="checkedr">N/A</span>
                                          @endif
                                        <span class="checkedgr">({{ $c }} persons)</span>
                                        </p>

                                        <p class="card-text "><b>Cost : </b><span class="checkedr">{{ $service->cost }} $ </span><span  class=".checkedg">[{{ $service->discount }} % off] </span></p>
                                        <p class="card-text">{{ $service->description }} <br>{{ $location->city }},{{ $location->district }},{{ $location->location }}</p>
                                        <p class="card-text"><b>Providers Info : </b>{{ $provider->name }}, Email:{{ $provider->email }}, Contact No:{{ $provider->contact_number }}</p>
                                        <div class="btn-group btn-group-justified">
                                        
                                            <form id="booking" action="{{ url('/book_now') }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="id" value="<?php echo $service->prvds_id; ?>"/>
                                                
                                                <button type="submit" class="btn btn-primary" >
                                                    {{ __('Book Now') }}
                                                </button>
                                            </form>
                                        
                                        
                                            <form id="rating" action="{{ url('/rating') }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="id" value="<?php echo $service->prvds_id; ?>"/>
                                                
                                                <button type="submit" class="btn btn-success" >
                                                    {{ __('Rate it') }}
                                                </button>
                                            </form>

                                            <form id="rating" action="{{ url('/see_review') }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="ser_id" value="<?php echo $service->prvds_id; ?>"/>
                                                
                                                <button type="submit" class="btn btn-warning" >
                                                    {{ __('See Review') }}
                                                </button>
                                            </form>
                                        
                                        </div>

                                      </div>
                                    </div>
                                </div>
                                @endif
                              @endforeach
                        </div>

                        
                    </div>
                </div>
            @endif

        @endif

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
