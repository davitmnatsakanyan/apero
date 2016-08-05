var app = angular.module('app', [
    'ngRoute', 'ngAnimate', 'ngSanitize', 'ngTouch', 'ui.bootstrap', 'toastr', 'flow','ui.select','angularModalService'
]);

app.config(['$interpolateProvider', 'toastrConfig', 'flowFactoryProvider','uiSelectConfig',
    function ($interpolateProvider, toastrConfig, flowFactoryProvider,uiSelectConfig) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');

        uiSelectConfig.theme = 'select2';

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
            templateUrl: 'templates/login.blade.php',
            controller: 'AuthController'
        })
        .when('/register', {
            templateUrl: 'templates/register.blade.php',
            controller: 'AuthController'
        })
        .when('/user/account', {
            templateUrl: 'templates/user/account/profile.blade.php',
            controller: 'UserProfileController'
        })
        .when('/user/orders', {
            templateUrl: 'templates/user/account/orders.blade.php',
            controller: 'UserOrdersController'
        })
        .when('/user/orders/:order_id', {
            templateUrl: 'templates/user/account/show_order.blade.php',
            controller: 'UserOrdersController'
        })
        .when('/caterers', {
            templateUrl: 'templates/caterers.blade.php',
            controller: 'SearchController'
        })
        .when('/caterer', {
            templateUrl: 'templates/caterer/account/profile.blade.php',
            controller: 'CatererProfileController'
        })
        .when('/caterer/packages', {
            templateUrl: 'templates/caterer/product/package/package.blade.php',
            controller: 'CatererPackageController'
        }) 
        .when('/caterer/packages/show/:package_id', {
            templateUrl: 'templates/caterer/product/package/show.blade.php',
            controller: 'CatererPackageController'
        })
        .when('/caterer/packages/edit/:package_id', {
            templateUrl: 'templates/caterer/product/package/edit.blade.php',
            controller: 'CatererPackageController'
        })
        .when('/caterer/profile', {
            templateUrl: 'templates/caterer/account/profile.blade.php',
            controller: 'CatererProfileController'
        })
        .when('/caterer/products', {
            templateUrl: 'templates/caterer/account/products.blade.php',
            controller: 'CatererProductsController'
        })
        .when('/caterer/orders', {
            templateUrl: 'templates/caterer/account/orders.blade.php',
            controller: 'CatererOrdersController'
        })
        .when('/caterer/orders/:order_id', {
            templateUrl: 'templates/caterer/account/show_order.blade.php',
            controller: 'CatererOrdersController'
        })
        .when('/caterer/show/:caterer_id', {
            templateUrl: 'templates/caterer.blade.php',
            controller: 'CatererController'
        })
        .when('/cart', {
            templateUrl: 'templates/cart.blade.php',
            controller: 'CartController'
        })
        .when('/order', {
            templateUrl: 'templates/order.blade.php',
            controller: 'OrderController'
        })
        .when('/', {
            templateUrl: 'templates/home.blade.php',
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

