var app = angular.module('app', [
    'ngRoute', 'ngAnimate', 'ngSanitize', 'ngTouch', 'ui.bootstrap'
]);

app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

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
        .when('/user/profile', {
            templateUrl: 'templates/user/account/profile.blade.php',
            controller: 'UserProfileController'
        })
        .when('/user/orders', {
            templateUrl: 'templates/user/account/orders.blade.php',
            controller: 'UserOrdersController'
        })
        .when('/caterers', {
            templateUrl: 'templates/caterers.blade.php',
            controller: 'SearchController'
        })
        .when('/caterer', {
            templateUrl: 'templates/caterer/account/profile.blade.php',
            controller: 'CatererOrdersController'
        })
        .when('/caterer/profile', {
            templateUrl: 'templates/caterer/account/profile.blade.php',
            controller: 'CatererOrdersController'
        })
        .when('/caterer/products', {
            templateUrl: 'templates/caterer/account/products.blade.php',
            controller: 'CatererProductsController'
        })
        .when('/caterer/orders', {
            templateUrl: 'templates/caterer/account/orders.blade.php',
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

