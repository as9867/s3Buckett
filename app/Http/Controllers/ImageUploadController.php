<?php
  
namespace App\Http\Controllers;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

  // use \Storage;

use Illuminate\Http\Request;
use Auth;

  
class ImageUploadController extends Controller
{
     
    public function imageUpload()
    {   

            // Auth::login('0');

          // Auth::logout();


//         $url = Storage::disk('s3')->temporaryUrl(
//    'images/0aXjzZR1nWesDoMhyskkcVAbdU7JQpz6LqZ7sVSh.png', Carbon::now()->addMinutes(5)
// );
        // echo "asa";
        // print_r($url);die;






          if(Auth::check()){

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

         // print_r($new_array);die;
          }



          else{
            // return view('login');

              return redirect('/login');
          }
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {

      

        $request->validate([
            'image' => 'required',
        ]);
    
        $imageName = time().'.'.$request->image->extension();  
     
        $path = Storage::disk('s3')->put('images', $request->image);

        $path = Storage::disk('s3')->url($path);
       $ss= explode('/',$path);

       // echo $ss[count($ss)-1];die;

        // print_r($ss);die;

        $sdd= Storage::disk('s3')->url($path.'/'.$imageName);


        $filename=Storage::disk('s3')->allFiles('');


        
    



       DB::table('images')->insert(
    array('user_id' => Auth::id(),
          'image' => $ss[count($ss)-1]
          
));



       // print_r($filename);die;

$url = Storage::disk('s3')->temporaryUrl(
   'images/0aXjzZR1nWesDoMhyskkcVAbdU7JQpz6LqZ7sVSh.png', Carbon::now()->addMinutes(5)
);


  
        /* Store $imageName name in DATABASE from HERE */
    
        return back()
            ->with('success','Uploaded');
            // ->with('image', $url); 
    }
}