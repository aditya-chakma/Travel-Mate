@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header"><h1><b>Add Locations | {{Auth::user()->role }}</b></h1></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('add.location') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>

                            <div class="col-md-6">
                                <input id="district" type="text" class="form-control" name="district" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="helpline" class="col-md-4 col-form-label text-md-right">{{ __('Helpline') }}</label>

                            <div class="col-md-6">
                                <input id="helpline" type="text" class="form-control" name="helpline" autofocus>
                            </div>
                        </div>
       
                        

                        


                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
