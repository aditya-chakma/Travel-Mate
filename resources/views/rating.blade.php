@extends('layouts.app')

<?php
$ps_id = $_GET['id'];
//echo $ps_id;
$service = DB::table('provided_service')->where('prvds_id',$ps_id)->first();
//echo $ps_id;
?>

@section('content')
<div class="container">
        <div class="row justify-content-center">
        <div class= "col-md-11">
        <div class="card">
            <div class="card-header"><h3>Give Review</h3></div>

            <div class="card-body">
            <form  action="{{ url('/rating') }}" method="POST">
                 @csrf
                 <div class="form-group">
                    <div size="" class="radio">
                        <label><input type="radio" name="star" value="5" checked> 
                            <span class="fa fa-star checkedr"></span> 
                            <span class="fa fa-star checkedr"></span> 
                            <span class="fa fa-star checkedr"></span> 
                            <span class="fa fa-star checkedr"></span> 
                            <span class="fa fa-star checkedr"></span>
                        </label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="star" value="4" > 
                            <span class="fa fa-star checkedo"></span> 
                            <span class="fa fa-star checkedo"></span> 
                            <span class="fa fa-star checkedo"></span> 
                            <span class="fa fa-star checkedo"></span>
                        </label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="star" value="3" > 
                            <span class="fa fa-star checkedy"></span> 
                            <span class="fa fa-star checkedy"></span> 
                            <span class="fa fa-star checkedy"></span>
                        </label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="star" value="2" > 
                            <span class="fa fa-star checkedg"></span> 
                            <span class="fa fa-star checkedg"></span>
                        </label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="star" value="1"> 
                            <span class="fa fa-star checkedb"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="comment">Comment : </label>
                    <textarea class="form-control" rows="3" id="comment" name="comment" placeholder="Say something about this service ..."></textarea>
                </div>
                <input type="hidden" name="id" value="<?php echo $ps_id;?>"/>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </div>
            </form>

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
