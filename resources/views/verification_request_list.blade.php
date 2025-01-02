@extends('layouts.app')

<?php
$pendingRequest = DB::table('pending_verfication')->get();
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
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Provider's Name</th>
                                <th scope="col">Provider's Email</th>
                                <th scope="col">Provider's Contact</th>
                                <th scope="col">Reffered Provider's Name</th>
                                <th scope="col">Reffered Provider's Email</th>
                                <th scope="col">Reffered Provider's Contact</th>

                                <th scope="col">Click</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingRequest as $user)
                            <?php
                            $provider = DB::table('service_providers')->where('auth_id', $user->self_id)->first();
                            $referer = DB::table('service_providers')->where('auth_id', $user->reffered_id)->first();
                            ?>
                            <tr>
                                <td>{{ $provider->name }}</td>
                                <td>{{ $provider->email }}</td>
                                <td>{{ $provider->contact_number }}</td>
                                <td>{{ $referer->name }}</td>
                                <td>{{ $referer->email }}</td>
                                <td>{{ $referer->contact_number }}</td>

                                <td>
                                    <form action="{{ url('/verify') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="self_id" value="{{ $provider->auth_id }}" />

                                        <button type="submit" class="btn btn-success btn-block">
                                            {{ __('Verified') }}
                                        </button>

                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


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