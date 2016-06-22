<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Socialite;

class SocialController extends Controller
{
    public function facebook_login()
    {
        return Socialite::with('facebook')->redirect();
    }
    
    public function facebook_callback()
    {
        $user = Socialite::driver('facebook')->user(); 
        dd("facebook");
        
    }
    
     public function twitter_login()
    {
        return Socialite::with('twitter')->redirect();
    }
    
    public function twitter_callback()
    {
        $user=Socialite::driver('twitter')->user(); 
        if(request()->has('code')){
        $user = Socialite::with('twitter');
        dd($user->user());}
        else 
            dd("hjjk");
//        $user=Socialite::driver('twitter')->user(); 
//        dd($user);
//        dd("twitter");
        
        
    }
        
}
