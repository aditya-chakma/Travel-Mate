@extends('layouts.app')

<?php
$ps_id = $_GET['id'];
?>

@section('content')
<div class="container">
        <div class="row justify-content-center">
        <div class= "col-md-11">
        <div class="card">
            <div class="card-header"><h3>Book Now</h3></div>

            <div class="card-body">
            <form action="{{ url('/book_now') }}" method="POST">
                 @csrf
                 <div class="form-group row">
                    <label for="book_date" class="col-md-4 col-form-label text-md-right">{{ __('Booking Date') }}</label>

                    <div class="col-md-6">
                        <input id="date" type="date" class="form-control" name="service_date" autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

                    <div class="col-md-6">
                        <input id="number" type="number" class="form-control" name="quantity">
                    </div>
                </div>
                
                <input type="hidden" name="service_id" value="<?php echo $ps_id;?>"/>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success btn-block">
                            {{ __('Book') }}
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
