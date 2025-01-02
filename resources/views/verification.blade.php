@extends('layouts.app')

<?php
$verifiedUser = DB::table('service_providers')->where('verified', 1)->get();
?>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3>Book Now</h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('/verification') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="ref_service_provider" class="col-md-4 col-form-label text-md-right">{{ __('Reffered Service Provider') }}</label>

                            <div class="col-md-6">
                                <select type="number" class="form-control" name="ref_service_provider_id" autofocus>
                                    @foreach($verifiedUser as $user)
                                    <option value="{{ $user->auth_id }}">{{ $user->name }},{{ $user->email }},{{ $user->contact_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>




                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success btn-block">
                                    {{ __('Ok') }}
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
                        <span class="pull-right"> | Developed by Rouf,Aditya & Shabuj</span>
                    </h6>
                </div>
            </div>
        </div>

        @endsection