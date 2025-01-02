<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customers;
use App\Service_Providers;
use App;
use Auth;
use File;
use Illuminate\Http\UploadedFile;

class UserInformationController extends Controller
{
    public function dataTable()
    {
        $users = DB::select('select * from users');
        return view('home', ['users' => $users]);
    }
    public function dataTableEmployee()
    {
        $users = DB::select('select * from employees');
        return view('home', ['employees' => $users]);
    }

    public function dataTableServiceProvider()
    {
        $users = DB::select('select * from service_providers');
        return view('home', ['service_providers' => $users]);
    }

    public function profile()
    {
        return view('profile');
    }

    public function update_profile_view()
    {
        return view('update_profile');
    }

    public function validatorCustomer(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'contact_number' => ['required', 'string', 'max:255', 'unique:customers'],
        ]);
    }


    public function update_profile(Request $request)
    {

        $imageFlag = false;
        $file_name = null;
        if ($request->file('image')) {
            $cover = $request->file('image');
            $extension = $cover->getClientOriginalExtension();
            request()->image->move(public_path('images'), time() . '.' . $extension);
            $file_name =  time() . '.' . $extension;
            $imageFlag = true;
        }










        //validatorCustomer($request);

        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'file_name' => $file_name,
            ]);



        $debug = "";
        if (Auth::user()->role == 'admin') {
            //-------------------------------//admin has no extra table
        } else if (Auth::user()->role == 'employee') {
            $ser = DB::table('employees')->where('auth_id', Auth::user()->id)->count();

            if ($ser == 0) {
                DB::table('employees')->insert(
                    [
                        'name' => $request->name,
                        'email' => $request->email,
                        'contact_number' => $request->contact_number,
                        'birth_date' => $request->birth_date,
                        'pos_id' => $request->roll,
                        'join_date' => $request->join_date,
                        'address' => $request->address,
                        'aid' => '1',
                        'auth_id' => Auth::user()->id,
                    ]
                );
            } else {
                DB::table('employees')
                    ->where('auth_id', Auth::user()->id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'contact_number' => $request->contact_number,
                        'birth_date' => $request->birth_date,
                        'pos_id' => $request->roll,
                        'join_date' => $request->join_date,
                        'address' => $request->address,
                        'aid' => 1,
                    ]);

                DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update(['enable_access' => false,]);
            }
        } else if (Auth::user()->role == 'service_provider') {
            //$debug = "dhukse";
            //$debug =$debug." ".$request->name;
            $ser = DB::table('service_providers')->where('auth_id', Auth::user()->id)->count();

            if ($ser == 0) {
                DB::table('service_providers')->insert(
                    [
                        'name' => $request->name,
                        'email' => $request->email,
                        'contact_number' => $request->contact_number,
                        'birth_date' => $request->birth_date,
                        'pos_id' => $request->roll,
                        'address' => $request->address,
                        'aid' => '1',
                        'auth_id' => Auth::user()->id,
                    ]
                );
            } else {
                DB::table('service_providers')
                    ->where('auth_id', Auth::user()->id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'contact_number' => $request->contact_number,
                        'birth_date' => $request->birth_date,
                        'pos_id' => $request->roll,
                        'address' => $request->address,
                        'aid' => 1,
                    ]);
                DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update(['enable_access' => false,]);
            }
        } else if (Auth::user()->role == 'customer') {

            $cus = DB::table('customers')->where('auth_id', Auth::user()->id)->count();

            if ($cus == 0) {
                $customers = new Customers([
                    'name' => $request->name,
                    'email' => $request->email,
                    'contact_number' => $request->contact_number,
                    'auth_id' => Auth::user()->id,
                ]);
                $customers->save();
            } else if ($cus == 1) {
                DB::table('customers')
                    ->where('auth_id', Auth::user()->id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'contact_number' => $request->contact_number
                    ]);
            }
        }







        if ($imageFlag) {
            return redirect('/home')->with('success', 'Successfully Updated your profile picture');
        } else return redirect('/home')->with('success', 'Successfully Updated all your info');
    }


    public function approve(Request $request)
    {

        DB::table('users')
            ->where('id', $request->id)
            ->update(['enable_access' => true,]);

        return redirect('/home')->with('message', $request->id . " is approved by you");
    }

    public function verificationPage()
    {
        return view('verification');
    }

    public function verificationRequestSent(Request $request)
    {
        $reffered_id = $request->ref_service_provider_id;
        $self_id = Auth::user()->id;

        DB::table('pending_verfication')->insert(
            [
                'self_id' => $self_id,
                'reffered_id' => $reffered_id,
            ]
        );

        DB::table('service_providers')->where('auth_id', Auth::user()->id)
            ->update(['verified' => 2,]);
        return redirect('/home')->with('success', 'Verification request Sent');
    }

    public function verification_request_list()
    {
        return view('verification_request_list');
    }

    public function verify(Request $request)
    {
        $auth_id = $request->self_id;
        DB::table('pending_verfication')->where('self_id', $auth_id)->delete();
        DB::table('service_providers')->where('auth_id', $auth_id)->update(['verified' => 1,]);
        return redirect('verification_request_list');
    }
}
