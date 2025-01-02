@extends('layouts.app')

@section('content')

<?php
$type = $_GET['type'];
$heading = "";
$bookingToday;
$bookingNextDay;
$bookingNextMonth;
$bookingThisMonth;
$bookingThisYear;
$pendingBooking;
$pendingSP;
$pendingEP;
$services;


switch ($type) {
    case 1:
        $heading = "Booking In ToDay";
        $today = date('d') + 1;
        //echo $today;
        $bookingToday = DB::table('bookings')
            ->whereRaw('DAY(service_date) = ?', [$today])
            ->get();

        break;
    case 2:
        $heading = "Booking In Next Day";
        $nextday = date('d') + 2;
        $bookingNextDay = DB::table('bookings')
            ->whereRaw('DAY(service_date) = ?', [$nextday])
            ->get();
        break;
    case 3:
        $heading = "Booking In this Month";
        $thismonth = date('m');
        $bookingThisMonth = DB::table('bookings')
            ->whereRaw('MONTH(service_date) = ?', [$thismonth])
            ->get();
        break;
    case 4:
        $heading = "Booking Upto Next Month";
        $nextmonth = (date('m') + 1) % 12;
        $bookingNextMonth = DB::table('bookings')
            ->whereRaw('MONTH(service_date) = ?', [$nextmonth])
            ->get();
        break;
    case 5:
        $heading = "Booking In This Year";
        $thisyear = date('Y');
        $bookingThisYear = DB::table('bookings')
            ->whereRaw('YEAR(service_date) = ?', [$thisyear])
            ->get();
        break;
    case 6:
        $heading = "Booked Services";
        $pendingBooking = DB::table('bookings')->get();
        break;
    case 7:
        $heading = "Pending Service Providers";
        $pendingSP = DB::table('users')->where('enable_access', 0)
            ->where('role', 'service_provider')
            ->get();
        break;
    case 8:
        $heading = "Pending Service Employees";
        $pendingEP = DB::table('users')->where('enable_access', 0)
            ->where('role', 'employee')
            ->get();
        break;
    case 9:
        $heading = "Pending Services";
        $services = DB::table('provided_service')->where('service_enable_bit', 0)->get();
        break;
    default:
        break;
}
?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-24">
                <div class="card">

                    <div class="card-header">
                        <h3><b>{{ $heading }}</b>
                            <h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-dark">
                            @if($type==1)

                            <thead>
                                <tr>
                                    <th scope="col">Service Name</th>
                                    <th scope="col">Service Type</th>
                                    <th scope="col">Service Cost</th>
                                    <th scope="col">Booking Date</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Providers Email</th>
                                    <th scope="col">Providers Contact</th>
                                    <th scope="col">Customers Email</th>
                                    <th scope="col">Customers Contact</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($bookingToday as $booking)
                                <?php
                                $service = DB::table('provided_service')->where('prvds_id', $booking->prvds_id)->first();
                                $location = DB::table('locations')->where('location_id', $service->location_id)->first();
                                $provider = DB::table('service_providers')->where('auth_id', $service->auth_id)->first();
                                $customer = DB::table('customers')->where('auth_id', $booking->auth_id)->first();
                                ?>
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->service_type }}</td>
                                    <td>{{ $service->cost }}</td>
                                    <td>{{ $booking->service_date }}</td>
                                    <td>{{ $location->location }}</td>
                                    <td>{{ $provider->email }}</td>
                                    <td>{{ $provider->contact_number }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->contact_number }}</td>
                                </tr>
                                @endforeach


                                @elseif($type==2)

                                <thead>
                                    <tr>
                                        <th scope="col">Service Name</th>
                                        <th scope="col">Service Type</th>
                                        <th scope="col">Service Cost</th>
                                        <th scope="col">Booking Date</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Providers Email</th>
                                        <th scope="col">Providers Contact</th>
                                        <th scope="col">Customers Email</th>
                                        <th scope="col">Customers Contact</th>
                                    </tr>
                                </thead>

                            <tbody>
                                @foreach($bookingNextDay as $booking)
                                <?php
                                $service = DB::table('provided_service')->where('prvds_id', $booking->prvds_id)->first();
                                $location = DB::table('locations')->where('location_id', $service->location_id)->first();
                                $provider = DB::table('service_providers')->where('auth_id', $service->auth_id)->first();
                                $customer = DB::table('customers')->where('auth_id', $booking->auth_id)->first();
                                ?>
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->service_type }}</td>
                                    <td>{{ $service->cost }}</td>
                                    <td>{{ $booking->service_date }}</td>
                                    <td>{{ $location->location }}</td>
                                    <td>{{ $provider->email }}</td>
                                    <td>{{ $provider->contact_number }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->contact_number }}</td>
                                </tr>
                                @endforeach
                                @elseif($type==3)

                                <thead>
                                    <tr>
                                        <th scope="col">Service Name</th>
                                        <th scope="col">Service Type</th>
                                        <th scope="col">Service Cost</th>
                                        <th scope="col">Booking Date</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Providers Email</th>
                                        <th scope="col">Providers Contact</th>
                                        <th scope="col">Customers Email</th>
                                        <th scope="col">Customers Contact</th>
                                    </tr>
                                </thead>

                            <tbody>
                                @foreach($bookingThisMonth as $booking)
                                <?php
                                $service = DB::table('provided_service')->where('prvds_id', $booking->prvds_id)->first();
                                $location = DB::table('locations')->where('location_id', $service->location_id)->first();
                                $provider = DB::table('service_providers')->where('auth_id', $service->auth_id)->first();
                                $customer = DB::table('customers')->where('auth_id', $booking->auth_id)->first();
                                ?>
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->service_type }}</td>
                                    <td>{{ $service->cost }}</td>
                                    <td>{{ $booking->service_date }}</td>
                                    <td>{{ $location->location }}</td>
                                    <td>{{ $provider->email }}</td>
                                    <td>{{ $provider->contact_number }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->contact_number }}</td>
                                </tr>
                                @endforeach

                                @elseif($type==4)
                                <thead>
                                    <tr>
                                        <th scope="col">Service Name</th>
                                        <th scope="col">Service Type</th>
                                        <th scope="col">Service Cost</th>
                                        <th scope="col">Booking Date</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Providers Email</th>
                                        <th scope="col">Providers Contact</th>
                                        <th scope="col">Customers Email</th>
                                        <th scope="col">Customers Contact</th>
                                    </tr>
                                </thead>

                            <tbody>
                                @foreach($bookingNextMonth as $booking)
                                <?php
                                $service = DB::table('provided_service')->where('prvds_id', $booking->prvds_id)->first();
                                $location = DB::table('locations')->where('location_id', $service->location_id)->first();
                                $provider = DB::table('service_providers')->where('auth_id', $service->auth_id)->first();
                                $customer = DB::table('customers')->where('auth_id', $booking->auth_id)->first();
                                ?>
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->service_type }}</td>
                                    <td>{{ $service->cost }}</td>
                                    <td>{{ $booking->service_date }}</td>
                                    <td>{{ $location->location }}</td>
                                    <td>{{ $provider->email }}</td>
                                    <td>{{ $provider->contact_number }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->contact_number }}</td>
                                </tr>
                                @endforeach
                                @elseif($type==5)
                                <thead>
                                    <tr>
                                        <th scope="col">Service Name</th>
                                        <th scope="col">Service Type</th>
                                        <th scope="col">Service Cost</th>
                                        <th scope="col">Booking Date</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Providers Email</th>
                                        <th scope="col">Providers Contact</th>
                                        <th scope="col">Customers Email</th>
                                        <th scope="col">Customers Contact</th>
                                    </tr>
                                </thead>

                            <tbody>
                                @foreach($bookingThisYear as $booking)
                                <?php
                                $service = DB::table('provided_service')->where('prvds_id', $booking->prvds_id)->first();
                                $location = DB::table('locations')->where('location_id', $service->location_id)->first();
                                $provider = DB::table('service_providers')->where('auth_id', $service->auth_id)->first();
                                $customer = DB::table('customers')->where('auth_id', $booking->auth_id)->first();
                                ?>
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->service_type }}</td>
                                    <td>{{ $service->cost }}</td>
                                    <td>{{ $booking->service_date }}</td>
                                    <td>{{ $location->location }}</td>
                                    <td>{{ $provider->email }}</td>
                                    <td>{{ $provider->contact_number }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->contact_number }}</td>
                                </tr>
                                @endforeach
                                @elseif($type==6)
                                <thead>
                                    <tr>
                                        <th scope="col">Service Name</th>
                                        <th scope="col">Service Type</th>
                                        <th scope="col">Service Cost</th>
                                        <th scope="col">Booking Date</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Providers Email</th>
                                        <th scope="col">Providers Contact</th>
                                        <th scope="col">Customers Email</th>
                                        <th scope="col">Customers Contact</th>
                                    </tr>
                                </thead>

                            <tbody>
                                @foreach($pendingBooking as $booking)
                                <?php
                                $service = DB::table('provided_service')->where('prvds_id', $booking->prvds_id)->first();
                                $location = DB::table('locations')->where('location_id', $service->location_id)->first();
                                $provider = DB::table('service_providers')->where('auth_id', $service->auth_id)->first();
                                $customer = DB::table('customers')->where('auth_id', $booking->auth_id)->first();
                                ?>
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->service_type }}</td>
                                    <td>{{ $service->cost }}</td>
                                    <td>{{ $booking->service_date }}</td>
                                    <td>{{ $location->location }}</td>
                                    <td>{{ $provider->email }}</td>
                                    <td>{{ $provider->contact_number }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->contact_number }}</td>
                                </tr>
                                @endforeach
                                @elseif($type==7)
                                <thead>
                                    <tr>
                                        <th scope="col">Providers Name</th>
                                        <th scope="col">Providers Email</th>
                                        <th scope="col">Providers Contact</th>
                                        <th scope="col">Birth Date</th>
                                        <th scope="col">Address</th>

                                    </tr>
                                </thead>

                            <tbody>
                                @foreach($pendingSP as $SP)
                                <?php
                                $provider = DB::table('service_providers')->where('auth_id', $SP->id)->first();
                                ?>
                                <tr>
                                    <td>{{ $provider->name }}</td>
                                    <td>{{ $provider->email }}</td>
                                    <td>{{ $provider->contact_number }}</td>
                                    <td>{{ $provider->birth_date }}</td>
                                    <td>{{ $provider->address }}</td>
                                </tr>
                                @endforeach
                                @elseif($type==8)
                                <thead>
                                    <tr>
                                        <th scope="col">Employee Name</th>
                                        <th scope="col">Employee Email</th>
                                        <th scope="col">Employee Contact</th>
                                        <th scope="col">Joining Date</th>
                                        <th scope="col">Address</th>

                                    </tr>
                                </thead>

                            <tbody>
                                @foreach($pendingEP as $EP)
                                <?php
                                $employee = DB::table('employees')->where('auth_id', $EP->id)->first();
                                ?>
                                <tr>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->contact_number }}</td>
                                    <td>{{ $employee->join_date }}</td>
                                    <td>{{ $employee->address }}</td>
                                </tr>
                                @endforeach
                                @elseif($type==9)
                                <thead>
                                    <tr>
                                        <th scope="col">Service Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Service Type</th>
                                        <th scope="col">Cost</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Providers Email</th>
                                        <th scope="col">Providers Contact</th>

                                    </tr>
                                </thead>

                            <tbody>
                                @foreach($services as $service)
                                <?php
                                $provider = DB::table('service_providers')->where('auth_id', $service->auth_id)->first();
                                $location = DB::table('locations')->where('location_id', $service->location_id)->first();
                                ?>
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->description }}</td>
                                    <td>{{ $service->service_type }}</td>
                                    <td>{{ $service->cost }} $</td>
                                    <td>{{ $service->discount }} %</td>
                                    <td>{{ $location->location }}</td>
                                    <td>{{ $provider->email }}</td>
                                    <td>{{ $provider->contact_number }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection