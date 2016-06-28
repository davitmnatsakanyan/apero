<?php
Route::get('aaa',function(){
  dd(bcrypt('caterer'));
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
        $template = str_replace(".blade.php","",$template);
        return view('templates.' . $template);
    }));
});

Route::group(array('prefix'=>'/templates/caterer/account'),function(){
    Route::get('{template}', array( function($template)
    {
        $template = str_replace(".blade.php","",$template);
        return view('templates/caterer/account.' . $template);
    }));
});
Route::group(array('prefix'=>'/templates/caterer/auth'),function(){
    Route::get('{template}', array( function($template)
    {
        $template = str_replace(".blade.php","",$template);
        return view('templates/caterer/auth.' . $template);
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
        Route::controller('user','UserManagmentController');
        Route::resource('members', 'MembersController');
        Route::controller('members', 'MembersController');


       Route::resource('caterers', 'CaterersController');
        
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
//    'middleware' => 'caterer',
    'namespace'  => 'Caterer',
    
     ],function(){
      
        Route::controller('account', 'AccountController');
        Route::controller('settings', 'SettingsController');
        Route::group([
            'prefix'    => 'product',
            'namespace' => 'ProductManagment',
        ],function(){

           Route::group([
               'prefix' => 'single'
           ],function(){
               Route::get('/','SingleProductController@getIndex');

               Route::get('add','SingleProductController@getAdd');
               Route::post('add','SingleProductController@postAdd');

               Route::get('view/{id}','SingleProductController@getView');

               Route::get('edit/{id}','SingleProductController@getEdit');
               Route::post('edit/{id}','SingleProductController@postEdit');

               Route::get('delete/{id}','SingleProductController@getDelete');
           });


           Route::group([
                   'prefix'    => 'package',
               ],function() {
               Route::get('/','PackageController@getIndex');

               Route::get('add', 'PackageController@getAdd');
               Route::post('add', 'PackageController@postAdd');
               
               Route::get('products/{category_id}', 'PackageController@getProducts');
               

           });
        });
        
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

Route::get('test', function(){
    return view('templates/caterer/auth/register');
});

    
    
    
