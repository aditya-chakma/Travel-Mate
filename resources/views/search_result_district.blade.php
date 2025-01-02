@extends('layouts.app')
<?php
    $city = session('city');
    $locations = DB::table('locations')->where('district',$city)->get();
    $c = 0;
    $message = session('message');
 ?>
@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class= "col-md-12">
    <div class="card">
    <div class="card-header"><h3>Search Result</h3><p class=".checkedgr">(by District)</p></div>
    <div class="card-body">
 
@if($message == 'null')
<div class="col-sm-12">
    
    <div class="widget">
            <div class="row">
                @foreach($locations as $location)
                    <?php 
                        $services = DB::table('provided_service')->where('location_id',$location->location_id)->get();
                    ?>
                    @foreach($services as $service)
                        @if($service->service_enable_bit)
                        <?php 
                        $l = DB::table('locations')->where('location_id',$service->location_id)->first();
                        $provider = DB::table('service_providers')->where('auth_id',$service->auth_id)->first();
                        $c++;
                        ?>
                        <div class="col-md-4">
                            <div class="card">
                              <div class="card-header"><h5 class="checkedb"><b>{{ $service->name }}</b></h5></div>
                                <img class="card-img-top feature-img" src="{{asset('images/'.$service->file_name)}}" alt="Card image" width="400" height="200">
                                <div class="card-body">
                                <?php 
                                          $ratings = DB::table('rating')->where('prvds_id',$service->prvds_id)->get();
                                          $cn = DB::table('rating')->where('prvds_id',$service->prvds_id)->count();
                                          $i = 0;
                                          $sum = 0;
                                          $lower = 0;
                                          $average = 0;
                                          if($cn != 0){
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
                                        <span class="checkedgr">({{ $cn }} persons)</span>
                                        </p>
                      
                                        <p class="card-text "><b>Cost : </b><span class="checkedr">{{ $service->cost }} $ </span><span  class=".checkedg">[{{ $service->discount }} % off] </span></p>
                                        <p class="card-text">{{ $service->description }} <br>{{ $location->city }},{{ $location->district }},{{ $location->location }}</p>
                                        <p class="card-text"><b>Providers Info : </b>{{ $provider->name }}, Email:{{ $provider->email }}, Contact No:{{ $provider->contact_number }}</p>
                                        <div class="btn-group btn-group-justified">
                                        
                                            <form id="booking" action="#" method="GET">
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
                @endforeach
            </div>

        
    </div>

    @if($c == 0)


    <div class="alert alert-danger">Currently, There is no services in <b>{{ $city }}</b> </div>
        
    @endif

@else

<?php 
    echo '<div class="alert alert-danger">Sorry! We have no service in '.$message.'!</div>'
?>

@endif
</div>
</div>
</div>
</div>
</div>
<br><br>
<div class="card">
    <div class="card-body">
        <h6>&copy 2019 All rights reserved
            <span class = "pull-right"> | Developed by Rouf,Aditya & Shabuj</span>
        </h6>
    </div>
</div>

@endsection