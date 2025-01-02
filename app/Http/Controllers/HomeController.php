<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function location()
    {
        return view('location');
    }

    public function addlocation(Request $request)
    {
        DB::table('locations')->insert(
            [
                'city' => $request->city,
                'district' => $request->district,
                'location' => $request->location,
                'aid' => '1',
            ]);

        $id = DB::table('locations')->where('city',$request->city)->first();
        
        DB::table('company')->insert(
            [
                'cmpn_name' => 'TravelMate-'.$request->city.'-'.$request->district,
                'description' => 'TravelMate-'.$request->district.'-'.$request->location,
                'e_mail' => 'travelmate'.'.'.$request->city.'@gmail.com',
                'location_id' => $id->location_id,
                'address' => $request->city,
                'contact_number' => $request->helpline,
                'aid' => '1',
            ]);
        return redirect('/home')->with('message',"Location is successfully added");
    }


    public function company()
    {
        return view('company');
    }

    public function addcompany(Request $request)
    {
        $imageflag = false;
        $file_name= "defaultplace.jpg";
        if($request->file('image'))
        {
            $cover = $request->file('image');
            $extension = $cover->getClientOriginalExtension();
            request()->image->move(public_path('images'), time().'.'.$extension);
            $file_name =  time().'.'.$extension;
            $imageFlag = true;
        }
        
        DB::table('company')->insert(
            [
                'cmpn_name' => $request->cmpn_name,
                'description' => $request->description,
                'e_mail' => $request->e_mail,
                'location_id' => $request->location_id,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'aid' => '1',
                'file_name' => $file_name,
                'auth_id' => Auth::user()->id,
            ]);
        
        return redirect('/home')->with('success',"Company Details is successfully added");
    }

    public function service()
    {
        return view('service');
    }

    public function addservice(Request $request)
    {
        $imageflag = false;
        $file_name= "defaultplace.jpg";
        if($request->file('image'))
        {
            $cover = $request->file('image');
            $extension = $cover->getClientOriginalExtension();
            request()->image->move(public_path('images'), time().'.'.$extension);
            $file_name =  time().'.'.$extension;
            $imageFlag = true;
        }

        $occupations = DB::table('service_providers')->where('auth_id',Auth::user()->id)->first();
        
        if($occupations->pos_id == 1)
        {
            $company = DB::table('company')->where('auth_id',Auth::user()->id)->first();
            if($company != null)
            {
                DB::table('provided_service')->insert(
                    [
                        'cmpn_id' => $company->cmpn_id,
                        'name' => $request->name,
                        'quantity' => $request->quantity,
                        'description' => $request->description,
                        'cost' => $request->cost,
                        'file_name' => $file_name,
                        'discount' => $request->discount,
                        'location_id' => $company->location_id,
                        'auth_id' => Auth::user()->id,
                        'service_type' => $request->service_type,
                        'service_enable_bit' => 0,
                    ]);
            }
           
        }
        else
        {
            $company = DB::table('company')->where('location_id',$request->location_id)->first();

           DB::table('provided_service')->insert(
                    [
                        'cmpn_id' => $company->cmpn_id,
                        'name' => $request->name,
                        'quantity' => $request->quantity,
                        'description' => $request->description,
                        'cost' => $request->cost,
                        'file_name' => $file_name,
                        'discount' => $request->discount,
                        'location_id' => $company->location_id,
                        'auth_id' => Auth::user()->id,
                        'service_type' => $request->service_type,
                        'service_enable_bit' => 0,
                    ]);
        }
        
        
        return redirect('/home')->with('success',"Service Details is successfully added & wait for authority approval");
    }

    public function updateservice(Request $request)
    {
        $id = $request->ser_id;
        return redirect('/service_update_form')->with('id',$id);
    }

    public function updateserviceform(Request $request)
    {
        
       return view('/service_update_form');
    }

    
    public function updateservicetodatabase(Request $request)
    {
        //$imageflag = false;
        $file_name= "defaultplace.jpg";
        if($request->file('image'))
        {
            $cover = $request->file('image');
            $extension = $cover->getClientOriginalExtension();
            request()->image->move(public_path('images'), time().'.'.$extension);
            $file_name =  time().'.'.$extension;
            //$imageFlag = true;
        }

        DB::table('provided_service')
                    ->where('prvds_id', $request->id)
                    ->update([
                        'name' => $request->name,
                        'quantity' => $request->quantity,
                        'description' => $request->description,
                        'cost' => $request->cost,
                        'file_name' => $file_name,
                        'discount' => $request->discount,
                        'service_enable_bit' => 0,
                    ]);
        
        return redirect('/home')->with('success',"Service Details is successfully updated. Wait for authority approval");
        
    }

    public function deleteservice(Request $request)
    {
        DB::table('provided_service')->where('prvds_id', $request->id)->delete();
        DB::table('rating')->where('prvds_id',$request->id)->delete();
        return redirect('/home')->with('success',"Service Details is successfully deleted");
    }

    public function approveservice(Request $request)
    {
        DB::table('provided_service')
                    ->where('prvds_id', $request->id)
                    ->update([
                        'service_enable_bit' => 1,
                    ]);
        
        return redirect('/home')->with('success',"Service Details is approved");
    }


    
    public function pendingfun()
    {
        return view('pending');
    }

    public function report()
    {
        return view('report');
    }
}
