@extends('layouts.master')
@section('content')
<?php

$prvds_id = $_GET['ser_id'];
$service = DB::table('provided_service')->where('prvds_id', $prvds_id)->first();
$location = DB::table('locations')->where('location_id', $service->location_id)->first();
$provider = DB::table('service_providers')->where('auth_id', $service->auth_id)->first();
//calculate review
$ratings = DB::table('rating')->where('prvds_id', $prvds_id)->get();
$c = DB::table('rating')->where('prvds_id', $prvds_id)->count();
$i = 0;
$sum = 0;
$lower = 0;
$average = 0;
if ($c != 0) {
  foreach ($ratings as $rating) {
    $i = $i + 1;
    $sum = $sum + $rating->star;
  }

  $average = $sum / $i;

  $lower = (int) $average;
}
$marginal = $lower + 0.5;
if ($average < $marginal) {
  $average = $lower;
} else {
  $average = $lower + 1;
}

//--------------

?>

@section('content')
<div class="container mt-3">
  <hr>
  <h2>Service Review </h2>
  <hr>
  <div class="card">
    <div class="row no-gutters">
      <div class="col-auto">
        <img src="{{asset('images/'.$service->file_name)}}" class="img-fluid" alt="" width="500" height="500">
      </div>
      <div class="col">
        <div class="card-block px-2 p-3">

          <h3 class="card-title">{{ $service->name }}</h3>
          <h5>Location :<small><i> {{ $location->city }},{{ $location->district }},{{ $location->location }}</i></small></h5>
          <h4>Rating :
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

          </h4>
          <p class="card-text">If you love being in the high places, this is one of the must go places that should be in your list
            if you are visiting there. It is located merely 40 kilometers away from the town and can be reached on open 4WD SUV Cars or with CNGs.</p>

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">More Info About This Service</button>
          <div class="modal" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">{{ $service->name }}</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                  <p class="card-text"><b>Service Description : </b>{{ $service->description }}</p>
                  <p class="card-text"><b>Service Cost : </b>{{ $service->cost }} $</p>
                  <p class="card-text"><b>Discount : </b>{{ $service->discount }} %</p>
                  <p class="card-text"><b>Providers Name : </b>{{ $provider->name }} </p>
                  @if($provider->verified != 1)
                  <p class="card-text"><b>Providers Status : </b> <small>(Uncorroborated)</small> </p>
                  @else
                  <p class="card-text"><b>Providers Status : </b> <small>(Verified)</small> </p>
                  @endif
                  <p class="card-text"><b>Providers Email : </b>{{ $provider->email }} </p>
                  <p class="card-text"><b>Providers Contact : </b>{{ $provider->contact_number }} </p>
                  <div class="alert alert-success">{{ $location->city }},{{ $location->district }},{{ $location->location }} </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <hr>
  <div class="container" p-3>
    <h3>
      <p><small><i>Our reviews Have a look ...</i></small></p>
    </h3>
  </div>
  <hr>
  @foreach($ratings as $rating)
  <?php
  $customer = DB::table('users')->where('id', $rating->auth_id)->first();
  ?>
  <div class="card">
    <div class="card-body">
      <div class="media border p-3">

        <img src="{{asset('images/'.$customer->file_name)}}" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
        <div class="media-body">
          <h4>{{ $customer->name }} </h4><small> {{ $customer->email }} </small> |
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
          <hr>

          <p>{{ $rating->comment }}</p>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>

@endsection