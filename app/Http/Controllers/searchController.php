<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class searchController extends Controller
{
    public function lcs($X, $Y, $m, $n)
    {
        if ($m == 0 || $n == 0)
            return 0;
        else if ($X[$m - 1] == $Y[$n - 1])
            return 1 + $this->lcs($X, $Y, $m - 1, $n - 1);
        else
            return max($this->lcs($X, $Y, $m, $n - 1), $this->lcs($X, $Y, $m - 1, $n));
    }

    public function searchcity(Request $request)
    {
        $city = $request->city;
        $cities = DB::table('locations')->get();

        $targetCity = "null";
        $dist = -99999;
        foreach ($cities as $citi) {
            $X = $city;
            $Y = $citi->city;
            $temp =  $this->lcs($X, $Y, strlen($X), strlen($Y));
            if ($temp > $dist) {
                $dist = $temp;
                $targetCity = $citi->city;
            }
        }
        //echo $targetCity;

        $count = DB::table('locations')->where('city', $targetCity)->count();
        if ($count == 0) {
            return redirect('/search_result')->with('message', $city)
                ->with('city', 'null');
        } else {

            return redirect('/search_result')->with('city', $targetCity)
                ->with('message', 'null');
        }
    }

    public function searchdistrict(Request $request)
    {
        $city = $request->district;
        //-------------------
        $cities = DB::table('locations')->get();

        $targetCity = "null";
        $dist = -99999;
        foreach ($cities as $citi) {
            $X = $city;
            $Y = $citi->district;
            $temp =  $this->lcs($X, $Y, strlen($X), strlen($Y));
            if ($temp > $dist) {
                $dist = $temp;
                $targetCity = $citi->district;
            }
        }
        //---------------------
        $count = DB::table('locations')->where('district', $targetCity)->count();
        if ($count == 0) {
            return redirect('/search_result_district')->with('message', $city)
                ->with('city', 'null');
        } else {
            return redirect('/search_result_district')->with('city', $targetCity)
                ->with('message', 'null');
        }
    }

    public function searchlocation(Request $request)
    {
        $city = $request->location;
        //-------------------
        $cities = DB::table('locations')->get();

        $targetCity = "null";
        $dist = -99999;
        foreach ($cities as $citi) {
            $X = $city;
            $Y = $citi->location;
            $temp =  $this->lcs($X, $Y, strlen($X), strlen($Y));
            if ($temp > $dist) {
                $dist = $temp;
                $targetCity = $citi->location;
            }
        }
        //---------------------
        $count = DB::table('locations')->where('location', $targetCity)->count();
        if ($count == 0) {
            return redirect('/search_result_location')->with('message', $city)
                ->with('city', 'null');
        } else {
            return redirect('/search_result_location')->with('city', $targetCity)
                ->with('message', 'null');
        }
    }

    public function searchresult()
    {
        return view('search_result');
    }

    public function searchresultdistrict()
    {
        return view('search_result_district');
    }

    public function searchresultlocation()
    {
        return view('search_result_location');
    }

    public function seereview()
    {
        return view('review');
    }

    public function filterBlade()
    {
        return view('filteredSearchResult');
    }

    public function filterNow(Request $request)
    {
        $date = $request->date;
        $price_range = $request->price_range;
        $location_id = $request->location_id;
        $service_type = $request->service_type;

        $bookings = DB::table('bookings')->where('service_date', $date)->get();
        $services = DB::table('provided_service')->where('cost', '<=', $price_range)
            ->where('service_type', $service_type)
            ->where('location_id', $location_id)
            ->get();
        $c = 0;

        foreach ($services as $service) {

            $vacant = true;
            foreach ($bookings as $booking) {
                if ($service->prvds_id == $booking->prvds_id && $service->quantity <= $booking->quantity) $vacant = false;
            }

            if ($vacant == true) {
                $result[$c] = $service->prvds_id;
                $c++;
            }
        }
        if ($c == 0) $result[0] = 0;
        return redirect('filteredSearchResult')->with('result', $result)
            ->with('size', $c);
    }
}
