<?php
Route::get('aaa',function(\Mailchimp $mailchimp){
    try {
            $mailchimp
                ->lists
                ->subscribe(
                    111111111,
                    ['email' => 'bastianjung8@gmail.com']
                );
        } catch (\Mailchimp_List_AlreadySubscribed $e) {
            dd($e->getMessage());
        }
        catch (\Mailchimp_Error $e) {
            dd($e->getMessage());
        }
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Templates
Route::group(array('prefix'=>'/templates/'),function(){
    Route::get('{template}', array( function($template)
    {
        $template = str_replace(".php","",$template);
        view()->addExtension('html','php');
        return view('templates.' . $template);
    }));
});

/**
 * Main routes
 */
Route::group([],function(){

    Route::get('/',function(){
        return view('index');
    });

    Route::controller('home','HomeController');
    Route::controller('auth','Auth\AuthController');
    
});

/**
 * Admin routes
 */


  Route::group([
    'prefix'     => 'admin',
    'middleware' => 'admin',
    'namespace'  => 'Admin',
    
     ],function(){
        Route::controller('dashboard', 'DashboardController');
        
   } );
   
    Route::controller('admin', 'Admin\AdminController');
    
/**
 * User routes
 */

    Route::group([
    'prefix'     => 'user',
    'middleware' => 'user',   
    'namespace'  => 'User',
    
     ],function(){
        Route::controller('account', 'AccountController');
        Route::controller('settings', 'SettingsController');
        
   } );
   
    /**
     * Caterer routes
     */

    
    Route::group([
    'prefix'     => 'caterer',
    'middleware' => 'caterer',   
    'namespace'  => 'Caterer',
    
     ],function(){
      
        Route::controller('account', 'AccountController');
        Route::controller('settings', 'SettingsController');
        
   } );
   
   
    /**
     * Social routes
     */
   Route::group([
        'prefix' => 'social'
         ] ,function(){
           Route::get('facebook_login','SocialController@facebook_login');
           Route::get('facebookcallback','SocialController@facebook_callback');
           
           Route::get('twitter_login','SocialController@twitter_login');
           Route::get('twittercallback','SocialController@twitter_callback');
           
         });

    
  
    
    
    
    
    
    
    
    
    
    
  
   // Paypal route
      
     Route::group([
         'prefix' => 'paypal',
     ],function(){
         Route::controller('', 'PaypalController');
     });
  
  
    //for checking htmls
    
    Route::get('hillfe',  function()
    {
        return view('hillfe/index');
    });
    
    
    Route::get('caterer',  function()
    {
        return view('caterer/index');
    });
    
    Route::get('bestellen',  function()
    {
        return view('bestellen/index');
    });

    
    
    