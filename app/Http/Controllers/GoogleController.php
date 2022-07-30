<?php
  
namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
// use App\Models\User;

use Illuminate\Support\Facades\Input;

  
class GoogleController extends Controller
{
    
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
      
  
    
    public function handleGoogleCallback()
    {
        try {
            // $authToken= Input::get('auth_token');
            $user =  Socialite::driver('google')->stateless()->user();

            // print_r($user);die;
     
            $finduser = User::where('google_id', $user->id)->first();
     
            if($finduser){
     
                Auth::login($finduser);

                // echo "1";die;
    
                return redirect('/home');
     
            }else{

                                // echo "2";die;

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);
    
                Auth::login($newUser);
     
                return redirect('/home');
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}