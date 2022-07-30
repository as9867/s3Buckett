<?php

namespace App\Http\Controllers;
use DB;

use Auth;
use Storage;
use Carbon\Carbon;

use Illuminate\Http\Request;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

 
    public function index()


    {

         $comm = DB::table('images')
        ->where('user_id', Auth::id() ) // Getting the Authenticated user id
       
        ->get();

        // print_r($comm);die;

        $new_array=[];

        foreach ($comm as $key => $value) {
            # code...

            $url = Storage::disk('s3')->temporaryUrl(
   'images/'.$value->image, Carbon::now()->addMinutes(5)
);
            $new_array[]=array('id'=>$key,'image'=>$url);
            // echo $value->image;
        // }
            // echo "<pre>";print_r($new_array);die;

            // return view('imageUpload');
        }
            return view('imageUpload', compact('new_array') );
    }
}
