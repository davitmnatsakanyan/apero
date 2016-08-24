<?php

Route::get('aaa', function(){
    return view('test');
    // the message
//    Mail::raw('some text', function ($m) {
//        $m->from('sona.khachatryan1995@gmail.com', 'Your Application');
//
//        $m->to('sona.khachatryan1995@gmail.com', 'aaaaa')->subject('Your Reminder!');
//    });
});

Route::get('bbb',function(){
    
try {
    $mandrill = new Mandrill('5lflfmsstLJrAvfqEir6Lg');
    $message = array(
        'html' => '<a>Example HTML content</a>',
        'text' => 'Please follow the link below to reset the password.',
        'subject' => 'example subject',
        'from_email' => 'bastianjung8@gmail.com',
        'from_name' => 'Example Name',
        'to' => array(
            array(
                'email' => 'bastinjung8@gmail.com',
                'name' => 'Recipient Name',
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => 'bastinjung8@gmail.com'),
        'important' => true,
        'track_opens' => null,
        'track_clicks' => null,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'bcc_address' => 'bastinjung8@gmail.com',
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'merge' => true,
        'merge_language' => 'mailchimp',
        'global_merge_vars' => array(
            array(
                'name' => 'merge1',
                'content' => 'merge1 content'
            )
        ),
        'merge_vars' => array(
            array(
                'rcpt' => 'bastinjung8@gmail.com',
                'vars' => array(
                    array(
                        'name' => 'merge2',
                        'content' => 'merge2 content'
                    )
                )
            )
        ),
        'tags' => array('password-resets'),
//        'subaccount' => 'customer-123',
        'google_analytics_domains' => array('example.com'),
        'google_analytics_campaign' => 'bastinjung8@gmail.com',
//        'metadata' => array('website' => 'www.example.com'),
//        'recipient_metadata' => array(
//            array(
//                'rcpt' => 'bastinjung8@gmail.com',
//                'values' => array('user_id' => 123456)
//            )
//        ),
//        'attachments' => array(
//            array(
//                'type' => 'text/plain',
//                'name' => 'myfile.txt',
//                'content' => 'ZXhhbXBsZSBmaWxl'
//            )
//        ),
//        'images' => array(
//            array(
//                'type' => 'image/png',
//                'name' => 'IMAGECID',
//                'content' => 'ZXhhbXBsZSBmaWxl'
//            )
//        )
    );
    $async = false;
    $ip_pool = 'Main Pool';
//    $send_at = 'example send_at';
    $result = $mandrill->messages->send($message, $async, $ip_pool,\Carbon\Carbon::now()->toDateTimeString());
    print_r($result);
    dd(1111);
    /*
    Array
    (
        [0] => Array
            (
                [email] => recipient.email@example.com
                [status] => sent
                [reject_reason] => hard-bounce
                [_id] => abc123abc123abc123abc123abc123
            )

    )
    */
} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    throw $e;
}


//    $apikey = 'c66eb8edb757c87f6a6a5ff519ece7c9-us13';
//
//    $to_emails = array('bastianjung8@gmail.com');
//    $to_names = array('You');
//
//    $message = [
//        'html'=>'Yo, this is the <b>html</b> portion',
//        'text'=>'Yo, this is the *text* portion',
//        'subject'=>'This is the subject',
//        'from_name'=>'Me!',
//        'from_email'=>'verifed@example.com',
//        'to_email'=>$to_emails,
//        'to_name'=>$to_names
//    ];
//
//    $tags = ['WelcomeEmail'];
//
//    $params = [
//        'apikey'=>$apikey,
//        'message'=>$message,
//        'track_opens'=>true,
//        'track_clicks'=>false,
//        'tags'=>$tags
//    ];
//
//    $url = "http://us1.sts.mailchimp.com/1.0/SendEmail";
//
//
//
//
//
//
//    try {
//        $ch = curl_init();
//
////        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
////            'Content-Type: application/x-www-form-urlencoded',
////        ));
//
//        curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($params));
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//        $result = curl_exec($ch);
////
////        curl_setopt($ch, CURLOPT_URL, "https://www.linkedin.com/oauth/v2/accessToken");
////
////        curl_setopt($ch, CURLOPT_POST, true);
////
////        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
////            'grant_type' => 'authorization_code',
////            'code' => $code,
////            'client_id' => '754enxbfv82979',
////            'client_secret' => 'jtN3EjVD1hqYkjeG'
////        ));
////
////
////        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
////
////        $server_output = curl_exec($ch);
//
//        if (FALSE === $result)
//            throw new Exception(curl_error($ch), curl_errno($ch));
//    }
//    catch(Exception $e) {
//
////        print_r($e->getMessage());die;
//        trigger_error(sprintf(
//            'Curl failed with error #%d: %s',
//            $e->getCode(), $e->getMessage()),
//            E_USER_ERROR);
//
//    }
//
////    $data = json_decode($result);
////    echo "Status = ".$data->status."\n";
//
////    SendEmail('c66eb8edb757c87f6a6a5ff519ece7c9-us13', array message, bool track_opens, bool track_clicks, array tags)
});

Route::get('ccc','PaypalController@getCheckout');

Route::any('upload', 'ImageController@uploadFile');

Route::get('stripe','StripeController@getindex');
Route::get('registerOrder','StripeController@registerOrder');
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

Route::group(array('prefix' => '/templates/caterer/product/single/modals/'), function () {
    Route::get('{template}', array(function ($template) {
        $template = str_replace(".blade.php", "", $template);
        return view('/templates/caterer/product/single/modals.' . $template);
    }));
});

Route::group(array('prefix' => '/templates/caterer/product/single'), function () {
    Route::get('{template}', array(function ($template) {
        $template = str_replace(".blade.php", "", $template);
        return view('/templates/caterer/product/single.' . $template);
    }));
});

Route::group(array('prefix' => '/templates/caterer/product/single/items'), function () {
    Route::get('{template}', array(function ($template) {
        $template = str_replace(".blade.php", "", $template);
        return view('/templates/caterer/product/single/items.' . $template);
    }));
});




/**
 * Main routes
 */
Route::group([], function () {

    Route::get('/', function () {
        return view('index');
    });

    Route::post('auth/passwordReset/checkEmailExists','Auth\PasswordController@checkEmailExists'); 
    Route::get('auth/passwordReset/checkEmail','Auth\PasswordController@checkEmail');
    Route::post('auth/passwordReset/reset','Auth\PasswordController@reset');
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

    Route::get('settings/update', 'SettingsController@getUpdate');
    Route::post('settings/update','SettingsController@postUpdate');
    Route::post('settings/changePassword','SettingsController@postChangePassword');

//    Route::controller('settings', 'SettingsController');

});

Route::post('order','OrderController@index');
Route::get('order/getAllZips','OrderController@getAllZips');
Route::get('order/getAllCountries','OrderController@getAllCountries');

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
    Route::post('settings/update','SettingsController@postUpdate');
    Route::get('settings/removeKitchen/{kitchen_id}','SettingsController@removeKitchen');
    Route::post('settings/addKitchen','SettingsController@addKitchen');
    Route::post('settings/changePassword','SettingsController@changePassword');
    Route::any('settings/uploadFile', 'SettingsController@uploadFile');
    
    Route::get('account','AccountController@getIndex');

    Route::controller('account', 'AccountController');
//    Route::controller('settings', 'SettingsController');
    
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
            Route::get('products/{kitchen_id}/{menu_id}/','SingleProductController@getProducts');
            Route::any('image/{id}','SingleProductController@chnageAvatar');
            Route::post('addSubproducts','SingleProductController@addSubproducts');
            
            Route::get('getAllKitchens','SingleProductController@getAllKitchens');
            Route::get('getAllMenus/{id}','SingleProductController@getAllMenus');

            Route::get('add', 'SingleProductController@getAdd');
            Route::post('add', 'SingleProductController@postAdd');

            Route::get('view/{id}', 'SingleProductController@getView');

            Route::post('update', 'SingleProductController@update');

            Route::get('delete/{id}', 'SingleProductController@getDelete');

            Route::post('updateSubproduct','SingleProductController@updateSubproduct');
            Route::get('deleteSubproduct/{id}', 'SingleProductController@deleteSubproduct');

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
            Route::any('package/image/{id}','PackageController@chnageAvatar');
            Route::get('package/delete/{id}','PackageController@removePackage');
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