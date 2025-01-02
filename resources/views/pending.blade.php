@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
        <div class= "col-md-11">
        <div class="card">

            <div class="card-body">

                <div class="alert alert-success"> Welcome <b>{{ Auth::user()->name }}</b> ! Your registration is pending! Our authority will approve you as soon as possible!</div>

                
            </div>

        </div>
        <br>
        <br>
        
        </div>
            
        <br>
        <br>
            <div class="card">
            <div class="card-body">
                <h6>&copy 2019 All right reserved
                    <span class = "pull-right">Developed by Rouf,Aditya & Shabuj</span>
                </h6>
            </div>
            </div>
        </div>
        <div >
</div>
@endsection
