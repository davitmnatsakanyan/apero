var app = angular.module('app', [
    'ngRoute', 'ngAnimate', 'ngTouch', 'ui.bootstrap', 'toastr', 'flow','ui.select','ngSanitize',
    'angularModalService','angularPayments','ui.bootstrap.datetimepicker'
]);

app.config(['$interpolateProvider', 'toastrConfig', 'flowFactoryProvider','uiSelectConfig','$windowProvider',
    function ($interpolateProvider, toastrConfig, flowFactoryProvider,uiSelectConfig,$windowProvider ) {
        var $window = $windowProvider.$get();
        // console.log($window);
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');

        uiSelectConfig.theme = 'select2';

        $window.Stripe.setPublishableKey('pk_test_RRDcRey63aipkR9UbaPDPRTo');

        flowFactoryProvider.defaults = {
            target: 'caterer/settings/updateAvatar',
            permanentErrors: [404, 500, 501],
            maxChunkRetries: 1,
            chunkRetryInterval: 5000,
            simultaneousUploads: 4,
            singleFile: true
        };

        flowFactoryProvider.on('catchAll', function (event) {
            console.log('catchAll', arguments);
        });

        angular.extend(toastrConfig, {
            closeButton: true,
            allowHtml: true,
        });
    }]);

app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
        .when('/login', {
            templateUrl: 'templates/login',
            controller: 'AuthController'
        })
        .when('/register', {
            templateUrl: 'templates/register',
            controller: 'AuthController'
        })
        .when('/passwordReset', {
            templateUrl: 'templates/passwordReset',
            controller: 'AuthController'
        })
        .when('/user/account', {
            templateUrl: 'templates/user/account/profile',
            controller: 'UserProfileController'
        })
        .when('/user/account/changePassword', {
            templateUrl: 'templates/user/account/changePassword',
            controller: 'UserProfileController'
        })
        .when('/user/orders', {
            templateUrl: 'templates/user/account/orders',
            controller: 'UserOrdersController'
        })
        .when('/user/orders/:order_id', {
            templateUrl: 'templates/user/account/show_order',
            controller: 'UserOrdersController'
        })
        .when('/caterers', {
            templateUrl: 'templates/caterers',
            controller: 'SearchController'
        })
        .when('/caterer', {
            templateUrl: 'templates/caterer/account/profile',
            controller: 'CatererProfileController'
        })
        .when('/caterer/packages', {
            templateUrl: 'templates/caterer/product/package/package',
            controller: 'CatererPackageController'
        })
        .when('/caterer/packages/add', {
            templateUrl: 'templates/caterer/product/package/add',
            controller: 'CatererPackageController'
        }) 
        .when('/caterer/packages/show/:package_id', {
            templateUrl: 'templates/caterer/product/package/show',
            controller: 'CatererPackageController'
        })
        .when('/caterer/packages/edit/:package_id', {
            templateUrl: 'templates/caterer/product/package/edit',
            controller: 'CatererPackageController'
        })
        .when('/caterer/product/edit/:product_id', {
            templateUrl: 'templates/caterer/product/single/edit',
            controller: 'EditProductController'
        })
        .when('/caterer/profile', {
            templateUrl: 'templates/caterer/account/profile',
            controller: 'CatererProfileController'
        })
        .when('/caterer/products', {
            templateUrl: 'templates/caterer/product/single/kitchens',
            controller: 'CatererProductsController'
        })
        .when('/caterer/:kitchen_id/menus', {
            templateUrl: 'templates/caterer/product/single/menus',
            controller: 'CatererProductsController'
        })
        .when('/caterer/:k_id/:menu_id/products',{
            templateUrl: 'templates/caterer/product/single/products',
            controller: 'CatererProductsController'
        })
        .when('/caterer/product/add',{
            templateUrl: 'templates/caterer/product/single/add',
            controller: 'CatererProductsController'
        })
        .when('/caterer/product/show/:product_id',{
            templateUrl: 'templates/caterer/product/single/view',
            controller: 'CatererProductsController'
        })
        .when('/caterer/orders', {
            templateUrl: 'templates/caterer/account/orders',
            controller: 'CatererOrdersController'
        })
        .when('/caterer/orders/:order_id', {
            templateUrl: 'templates/caterer/account/show_order',
            controller: 'CatererOrdersController'
        })
        .when('/caterer/show/:caterer_id', {
            templateUrl: 'templates/caterer',
            controller: 'CatererController'
        })
        .when('/cart', {
            templateUrl: 'templates/cart',
            controller: 'CartController'
        })
        .when('/order', {
            templateUrl: 'templates/order',
            controller: 'OrderController'
        })
        .when('/', {
            templateUrl: 'templates/home',
            controller: 'HomeController'
        })
        .otherwise({
            redirectTo: '/'
        });
}]);

//app.run(function ($rootScope, $location, $route, AuthService) {
//
//
//})

