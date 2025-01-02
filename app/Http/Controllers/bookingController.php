<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class bookingController extends Controller
{
    public function booknow()
    {
        return view('/book_now');
    }

    public function booksubmit(Request $request)
    {
        $condition = DB::table('bookings')->where('auth_id', Auth::user()->id)
            ->where('prvds_id', $request->service_id)->count();

        $service = DB::table('provided_service')->where('prvds_id', $request->service_id)->first();

        $bookedService = DB::table('bookings')->where('prvds_id', $request->service_id)
            ->where('service_date', $request->service_date)
            ->get();
        $quantityCount = 0;

        foreach ($bookedService as $booked) {
            $quantityCount = $quantityCount + $booked->quantity;
        }
        if ($condition == 1) {
            return redirect('/home')->with('success', 'You have already booked this service');
        } else if (($service->quantity - $quantityCount) < $request->quantity) {
            return redirect('/home')->with('success', 'We have not enough occupations! SORRY');
        } else {
            DB::table('bookings')->insert(
                [
                    'quantity' => $request->quantity,
                    'auth_id' => Auth::user()->id,
                    'service_date' => $request->service_date,
                    'prvds_id' => $request->service_id,
                ]
            );
            return redirect('/home')->with('success', 'You have successfully booked this service');
        }
    }

    public function bookedservice()
    {
        return view('booked_service');
    }

    public function cancelbooking()
    {
        $booking_id = $_GET['booking_id'];

        DB::table('bookings')->where('booking_id', $booking_id)->delete();
        return redirect('/booked_service');
    }

    public function approvebook()
    {
        return view('approve_book');
    }
}
