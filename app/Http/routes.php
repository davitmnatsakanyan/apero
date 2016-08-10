<?php

Route::get('aaa', 'User\SettingsController@getUpdate');

Route::get('bbb',function(){
    dd(auth('user')->user()->toArray());
});

Route::get('ccc','PaypalController@getCheckout');

Route::get('stripe','StripeController@getindex');
Route::post('registerOrder','StripeController@registerOrder');
Route::get('stripe/success', 'StripeController@success');
Route::get('stripe/register','StripeController@register');
Route::get('stripe/accounts','StripeController@listAccounts');
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
// Angular Templates

Route::group(array('prefix' => '/templates/'), function () {
    Route::get('{template}', array(function ($template) {
        $template = str_replace(".blade.php", "", $template);
        return view('templates.' . $template);
    }));
});

Route::group(array('prefix' => '/templates/modals'), function () {
    Route::get('{template}', array(function ($template) {
        $template = str_replace(".blade.php", "", $template);
        return view('templates/modals.' . $template);
    }));
});

Route::group(array('prefix' => '/templates/caterer/account'), function () {
    Route::get('{template}', array(function ($template) {
        $template = str_replace(".blade.php", "", $template);
        return view('templates/caterer/account.' . $template);
    }));
});

Route::group(array('prefix' => '/templates/caterer/account/items'), function () {
    Route::get('{template}', array(function ($template) {
        $template = str_replace(".blade.php", "", $template);
        return view('templates/caterer/account/items.' . $template);
    }));
});

Route::group(array('prefix' => '/templates/caterer/auth'), function () {
    Route::get('{template}', array(function ($template) {
        $template = str_replace(".blade.php", "", $template);
        return view('templates/caterer/auth.' . $template);
    }));
});

Route::group(array('prefix' => '/templates/user/auth'), function () {
    Route::get('{template}', array(function ($template) {
        $template = str_replace(".blade.php", "", $template);
        return view('templates/user/auth.' . $template);
    }));
});

Route::group(array('prefix' => '/templates/user/account'), function () {
    Route::get('{template}', array(function ($template) {
        $template = str_replace(".blade.php", "", $template);
        return view('templates/user/account.' . $template);
    }));
});

Route::group(array('prefix' => '/templates/caterer/account/modals'), function () {
    Route::get('{template}', array(function ($template) {
        $template = str_replace(".blade.php", "", $template);
        return view('templates/caterer/account/modals.' . $template);
    }));
});

Route::group(array('prefix' => '/templates/caterer/product/package'), function () {
    Route::get('{template}', array(function ($template) {
        $template = str_replace(".blade.php", "", $template);
        return view('/templates/caterer/product/package.' . $template);
    }));
});

Route::group(array('prefix' => '/templates/caterer/product/package/items/'), function () {
    Route::get('{template}', array(function ($template) {
        $template = str_replace(".blade.php", "", $template);
        return view('/templates/caterer/product/package/items/.' . $template);
    }));
});

Route::group(array('prefix' => '/templates/caterer/product/package/modals/'), function () {
    Route::get('{template}', array(function ($template) {
        $template = str_replace(".blade.php", "", $template);
        return view('/templates/caterer/product/package/modals.' . $template);
    }));
});

Route::group(array('prefix' => '/templates/caterer/product/single'), function () {
    Route::get('{template}', array(function ($template) {
        $template = str_replace(".blade.php", "", $template);
        return view('/templates/caterer/product/single.' . $template);
    }));
});




/**
 * Main routes
 */
Route::group([], function () {

    Route::get('/', function () {
        return view('index');
    });

    Route::controller('home', 'HomeController');
    Route::controller('auth', 'Auth\AuthController');

});

/**
 * Admin routes
 */


Route::group([
    'prefix' => 'admin',
    'middleware' => 'admin',
    'namespace' => 'Admin',

], function () {
    Route::controller('dashboard', 'DashboardController');
    Route::controller('user', 'UserManagmentController');

    Route::get('members/blocked' , 'MembersController@getBlocked' );
    Route::get('members/active/{id}' ,'MembersController@activate' );
    Route::get('members/block/{id}','MembersController@block');
    Route::resource('members', 'MembersController');

    Route::get('orders', 'OrdersController@getIndex');
    Route::get('orders/blocked', 'OrdersController@getBlockedOrders');
    Route::post('orders/changeStatus', 'OrdersController@postChangeStatus');
    Route::get('orders/activate/{id}' ,'OrdersController@getActivate');
    Route::get('orders/delete/{id}' , 'OrdersController@getDelete');
    Route::get('orders/{id}' , 'OrdersController@getShow');
    Route::get('orders/{id}/block', 'OrdersController@getBlock');



    Route::get('caterers/blocked', 'CaterersController@blockedCaterers');
    Route::post('caterers/delivery-area','CaterersController@addDeliveyArea');
    Route::get('caterers/{id}/block', 'CaterersController@block');
    Route::get('caterers/{id}/active', 'CaterersController@activate');
    Route::post('caterers/kitchens/add' , 'CaterersController@addKitchen');
    Route::post('caterers/edit-cooking-time', 'CaterersController@editCookingTime');
    Route::get('caterers/{caterer_id}/remove/{zip_id}' , 'CaterersController@removeZipFromDeliveryArea');
    Route::delete('caterers/{caterer_id}/kitchen/{kitchen_id}' , 'CaterersController@removeKitchen');
    Route::resource('caterers', 'CaterersController');

    Route::get('kitchens/{id}/block', 'KitchensController@block');
    Route::get('kitchens/{id}/active', 'KitchensController@activate');
    Route::get('kitchens/blocked', 'KitchensController@blockedKitchens');
    Route::resource('kitchens', 'KitchensController');

    Route::get('menus/{id}/block', 'MenusController@block');
    Route::get('menus/{id}/active', 'MenusController@activate');
    Route::get('menus/blocked', 'MenusController@blockedMenus');
    Route::resource('menus', 'MenusController');

    Route::get('products/{id}/block', 'ProductsController@block');
    Route::get('products/{id}/active', 'ProductsController@activate');
    Route::get('products/blocked', 'ProductsController@blockedProducts');
    Route::get('products/create/{id}', 'ProductsController@getKitchens');
    Route::get('products/create/menu/{id}', 'ProductsController@getMenus');
    Route::post('products/change_cutom','ProductsController@postUpdateSubproduct');
    Route::post('products/deleteSubproduct', 'ProductsController@postDeleteSubproduct');
    Route::resource('products', 'ProductsController');


    Route::get('packages/{id}/block', 'PackagesController@block');
    Route::post('packages/editcount', 'PackagesController@editProductCount');
    Route::delete('packages/product/{id}', 'PackagesController@deleteProduct');
    Route::get('packages/{id}/active', 'PackagesController@activate');
    Route::get('packages/blocked', 'PackagesController@blockedProducts');
    Route::get('packages/create/{id}', 'PackagesController@getProducts');
    Route::resource('packages', 'PackagesController');
}
);


Route::controller('admin', 'Admin\AdminController');

/**
 * User routes
 */

Route::group([
    'prefix' => 'user',
    'middleware' => 'user',
    'namespace' => 'User',

], function () {
    Route::get('/' ,'AccountController@getIndex');
    Route::get('order/show/{order_id}', 'AccountController@getOrder' );
    Route::group(['prefix' => 'account'],function(){
        Route::get('/', 'AccountController@getIndex');
        Route::get('view', 'AccountController@getView');
    });
    Route::controller('settings', 'SettingsController');

});

Route::post('order','OrderController@index');

/**
 * Caterer routes
 */

Route::get('get/caterer/{id}', 'Caterer\CatererController@getCaterer');

Route::group([
    'prefix' => 'caterer',
    'middleware' => 'caterer',
    'namespace' => 'Caterer',

], function () {
    Route::get('/' ,'AccountController@getIndex');
    Route::get('settings/updateAvatar','SettingsController@updateAvatar');

    Route::post('settings/updateContactPerson','SettingsController@updateContactPerson');
    Route::post('settings/addDeliveryArea','SettingsController@addDeliveryArea');
    Route::get('settings/removeDeliveryArea/{id}','SettingsController@removeDeliveryArea');
    Route::post('settings/editCookingTime','SettingsController@editCookingTime');

    Route::controller('account', 'AccountController');
    Route::controller('settings', 'SettingsController');
    
    Route::get('order' ,'OrdersController@getIndex');
    Route::get('order/show/{id}' , 'OrdersController@getShow');
    Route::get('order/accept/{id}' , 'OrdersController@getAccept');
    Route::post('order/change-status' , 'OrdersController@changeStatus');

    Route::group([
        'prefix' => 'product',
        'namespace' => 'ProductManagment',
    ], function () {
        Route::group([
            'prefix' => 'single'
        ], function () {
            Route::get('kitchens' , 'SingleProductController@getKitchens');
            Route::get('/', 'SingleProductController@getIndex');
            Route::get('menus/{id}', 'SingleProductController@getMenus');

            Route::get('add', 'SingleProductController@getAdd');
            Route::post('add', 'SingleProductController@postAdd');

            Route::get('view/{id}', 'SingleProductController@getView');

            Route::get('edit/{id}', 'SingleProductController@getEdit');
            Route::post('edit/{id}', 'SingleProductController@postEdit');

            Route::get('delete/{id}', 'SingleProductController@getDelete');

            Route::post('change_cutom','SingleProductController@postUpdateSubproduct');
            Route::post('deleteSubproduct', 'SingleProductController@postDeleteSubproduct');

        });

//
//        Route::group([
//            'prefix' => 'package',
//        ], function () {

//            Route::post('edit/{id}','PackageController@update');
//            Route::post('editcount', 'PackageController@editProductCount');
//            Route::delete('product/{id}', 'PackageController@deleteProduct');
//            Route::get('{id}/edit' , 'PackageController@edit');
            Route::post('package/getAllProducts','PackageController@getAllProducts');
            Route::post('package/addProduct/{id}','PackageController@addProducts');
            Route::post('package/removeProduct', 'PackageController@deleteProduct');
            Route::post('package/editcount','PackageController@editProductCount');
            Route::resource('package', 'PackageController');

//        });

        Route::group([
            'prefix' => 'kitchens'
        ], function () {
            Route::get('/', 'KitchensController@getIndex');
            Route::post('add', 'KitchensController@getAdd');
            Route::delete('delete/{id}', 'KitchensController@getDelete');
        });
    });

});


/**
 * Social routes
 */
Route::group([
    'prefix' => 'social'
], function () {
    Route::get('facebook_login', 'SocialController@facebook_login');
    Route::get('facebookcallback', 'SocialController@facebook_callback');

    Route::get('twitter_login', 'SocialController@twitter_login');
    Route::get('twittercallback', 'SocialController@twitter_callback');

});


// Paypal route

Route::group([
    'prefix' => 'paypal',
], function () {
    Route::get('checkout', 'PaypalController@getCheckout');
    Route::get('done', 'PaypalController@getDone');
    Route::get('cancel', 'PaypalController@getCancel');
});


//for checking htmls

Route::get('hillfe', function () {
    return view('hillfe/index');
});


Route::get('caterer', function () {
    return view('caterer/index');
});



Route::get('bestellen', function () {
    return view('bestellen/index');
});
Route::get('search/caterers', 'SearchController@getCaterers');

//Route::any('{catchall}', function () {
//    return redirect('/');
//})->where('catchall', '(.*)');
//Route::get('distance/{from}/{to}', function($from, $to){
//    echo '<a href="https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$from.'&destinations='.$to.'&key=AIzaSyAGarKqa_51bXdWy_ly_d8Znbnc36SqKfk">get distance </a>';
//});

Route::get('distance/{from}/{to}', function($from, $to){
    $data = [
        'units' => 'imperial',
        'origins' => $from,
        'destinations' => $to,
        'key' => env('GOOGLE_DISTACE_MATRIX_API_KEY')
    ];

//    $response = Curl::to('https://maps.googleapis.com/maps/api/distancematrix/json')
//        ->withData($data)
//        ->get();
//    dd($response);

    $client = new \GuzzleHttp\Client();
    $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/distancematrix/json', [
        'units' => 'imperial',
        'origins' => $from,
        'destinations' => $to,
        'key' => env('GOOGLE_DISTACE_MATRIX_API_KEY')
    ]);
    echo $res->getStatusCode();
// 200
    echo $res->getHeaderLine('content-type');
// 'application/json; charset=utf8'
    echo $res->getBody();
// {"type":"User"...'
});
Route::get('map', function(){
    return view('welcome');
});