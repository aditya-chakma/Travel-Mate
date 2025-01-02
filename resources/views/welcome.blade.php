@extends('layouts.master')
@section('content')
<div class="flex-center position-ref full-height">
            

        <!--end navigation part-->
        <!--side bar-->
        <div class ='container margin-top-20'>
          <hr>
          <hr>
        <div class="row">
              <div class="col-sm-15">
                  <h3>Our available Services</h3>
                  <hr>
                  <div class="widget">
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
                                        <div class="btn-group btn-group-justified">
                                        

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
            </div>
        </div>
        
        <!--end side bar-->
</div>





@endsection
  