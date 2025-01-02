<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class ratingController extends Controller
{
    public function rating()
    {
        return view('rating');
    }

    public function castRating(Request $request)
    {
       $service_id = $request->id;
       $user_id = Auth::user()->id;
       $count = DB::table('rating')->where('prvds_id',$service_id)
                                    ->where('auth_id',$user_id) ->count();
      if($count == 0)
      {
        DB::table('rating')->insert(
            [
                'prvds_id' => $service_id,
                'auth_id' => $user_id,
                'star' => $request->star,
                'comment' => $request->comment,
            ]);
      }
      else
      {
        DB::table('rating')
            ->where('prvds_id',$service_id)
            ->where('auth_id',$user_id)
            ->update(
            [
                'star' => $request->star,
                'comment' => $request->comment,
            ]);
      }

        return redirect('/home')->with('success','Thanks for your review. It will help us to improve our service.');
    }
}
