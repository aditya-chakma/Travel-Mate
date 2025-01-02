@extends('layouts.app')

@section('content')

<?php
$ps_id = session('id');
$service = DB::table('provided_service')->where('prvds_id',$ps_id)->first();
//echo $ps_id;
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header"><h3>Update Service<h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update.service.form') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="<?php echo $service->prvds_id; ?>"/>
                        <div class="form-group row">
                            <label for="Service_name" class="col-md-4 col-form-label text-md-right">{{ __('Service Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $service->name }}" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

                            <div class="col-md-6">
                                <input id="quantity" type="text" class="form-control" name="quantity" value="{{ $service->quantity }}" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ $service->description }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cost" class="col-md-4 col-form-label text-md-right">{{ __('Cost') }}</label>

                            <div class="col-md-6">
                                <input id="cost" type="text" class="form-control" name="cost" value="{{ $service->cost }}" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="discount" class="col-md-4 col-form-label text-md-right">{{ __('Discount') }}</label>

                            <div class="col-md-6">
                                <select id="discount" name="discount" class="form-control">
                                    <option value= "{{ $service->discount }}">{{ $service->discount }} %</option>
                                    <option value= "0">0%</option>
                                    <option value= "5">5%</option>
                                    <option value= "10">10%</option>
                                    <option value= "20">20%</option>
                                    <option value= "25">25%</option>
                                    <option value= "30">30%</option>
                                    <option value= "40">40%</option>
                                    <option value= "60">60%</option>
                                    <option value= "75">75%</option>
                                    <option value= "80">80%</option>
                                </select>
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Upload Photo') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control-file" name="image" value= "{{ $service->file_name }}"  autofocus>
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
