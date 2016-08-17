app.controller('OrderController', [ '$rootScope', '$scope', '$http', 'AuthService','$uibModal','$document','CatererAccountModel',
    'toastr','$window',
    function ( $rootScope, $scope, $http, AuthService,$uibModal,$document,CatererAccountModel,toastr,$window) {

    $('#datetimepicker4').datetimepicker();

    $scope.number="";$scope.expiry="";$scope.cvc="";

    if(JSON.parse(localStorage.getItem('cart'))){
        $scope.products = JSON.parse(localStorage.getItem('cart'))[0].products;
        $scope.packages = JSON.parse(localStorage.getItem('cart'))[0].packages;
    }
    else{
        $scope.products = '';
    }
        
    if(localStorage.getItem('total_price'))
        $scope.total_price = localStorage.getItem('total_price');
    else
        $scope.total_price = 0;

        if(localStorage.getItem('delivery_time'))
            $scope.delivery_time = localStorage.getItem('delivery_time');
        else
            $scope.delivery_time = new Date();

    var new_total_price;
    $scope.removeFromCart = function(index, total_price, type){

        $products = JSON.parse(localStorage.getItem('cart'))[0].products;
        $packages = JSON.parse(localStorage.getItem('cart'))[0].packages;

        if(type == 'product')
            new_total_price = total_price -  ($products[index].price * $products[index].count);
        else
            new_total_price = total_price -  ($packages[index].price * $packages[index].count);

        localStorage.setItem('total_price', new_total_price);
        $scope.total_price = new_total_price;

        if(type == 'product') {

            $products.splice(index, 1);

            if ($products.length == 0 && $packages.length == 0) {
                localStorage.removeItem('cart');
                localStorage.removeItem('total_price');
            }
            else {
                var orders = JSON.parse(localStorage.getItem('cart'));
                orders[0].products = $products;
                localStorage.setItem('cart', JSON.stringify(orders));
            }

            $scope.products = $products;
        }
        else{
            $packages.splice(index, 1);

            if ($products.length == 0 && $packages.length == 0) {
                localStorage.removeItem('cart');
                localStorage.removeItem('total_price');
            }
            else {
                var orders = JSON.parse(localStorage.getItem('cart'));
                orders[0].packages = $packages;
                localStorage.setItem('cart', JSON.stringify(orders));
            }

            $scope.packages = $packages;
        }


    }
        CatererAccountModel.getAllZips().then(
            function(response){
                $scope.zips = [];
                var zips = response.data.zips;
                for(zip in zips){
                    $scope.zips.push({
                        id:zips[zip].id,
                        name:zips[zip].ZIP + " " +zips[zip].city,
                    });
                }
            }
        );


        CatererAccountModel.getAllCountries().then(
            function(response){
                $scope.countries = [];
                var countries = response.data.countries;
                for(country in countries){
                    $scope.countries.push({
                        id:countries[country].id,
                        name:countries[country].name,
                    });
                }
            }
        );

        $scope.selectZip = function ($item, $model){
            $scope.delivery_zip =  $model;
        }


        $scope.selectCountry = function ($selected, $model){
            $scope.country =  $model;
        }

    $scope.change = function(){
        if($scope.is_different)
            $scope.is_different = false;
        else
            $scope.is_different = true;

    }

    $scope.payment = {
        name: 'cash'
    }
    $scope.submitOrder = function(payment){
        if(payment.name === 'stripe')
        {
             $scope.open();
             // $scope.registerOrder();

        }

        if(payment.name === 'paypal')
        {
            console.log('paypal');
            $http({
                method : "get",
                url : "ccc"
            }).success(function (response) {
            if(response.redirectUrl)
                $window.location.href = response.redirectUrl;
            else {
                console.log('redirecturl is broken');
            }
        }).error( function (error) {
            console.log('redirecturl is broken');
        });
        }
        
        if(payment.name == 'cash'){
            $scope.registerOrder();
        }
    };

    $scope.registerOrder = function()
    {
        console.log(12);
        var company = $scope.company;
        var delivery_country = $scope.country.id;
        var delivery_city = $scope.city;
        var orders = JSON.parse(localStorage.getItem('cart'))[0];
        var delivery_address = $scope.address+' '+ $scope.home;
        var delivery_zip = $scope.delivery_zip.id;
        var email = $scope.email;
        var mobile = $scope.mobile;
        var phone = $scope.phone;
        var billing_address  =$scope.billing_address;
        var payment_type = $scope.payment.name;
        var comment = $scope.comment;
        var is_logedin = $rootScope.is_logedin;
        var is_accepted = $scope.is_accepted;
        var delivery_time = $scope.delivery_time;
         if($scope.stripeToken)
             var stripeToken = $scope.stripeToken;
        else
             var stripeToken = "";

        console.log($scope.stripeToken);
        var data =  {
            company :           company,
            orders :            orders,
            delivery_country :  delivery_country,
            delivery_city :     delivery_city,
            delivery_address :  delivery_address,
            delivery_zip :      delivery_zip,
            email:              email,
            mobile :            mobile,
            phone:              phone,
            billing_address :   billing_address,
            payment_type :      payment_type,
            comment :           comment,
            is_logedin :        is_logedin,
            is_accepted:        is_accepted,
            delivery_time:      delivery_time,
            stripeToken:        stripeToken
        };
        console.log('es em');
        $http({
            data: {
                company :           company,
                delivery_country :  delivery_country,
                delivery_city :     delivery_city,
                orders :            orders,
                delivery_address :  delivery_address,
                delivery_zip :      delivery_zip,
                email:              email,
                mobile :            mobile,
                phone:              phone,
                billing_address :   billing_address,
                payment_type :      payment_type,
                comment :           comment,
                is_logedin :        is_logedin,
                is_accepted:        is_accepted,
                delivery_time:      delivery_time,
                stripeToken:        stripeToken
            },
            method : "POST",
            url : "order"
        }).then(
            function (response) {
                if(response.data.success){
                    toastr.success(response.data.message);
                }

                else{
                    toastr.error(responce.data.error, 'Error');
                }
            },
            function (error) {
                $scope.errorMessages(error);

            }
        );

    }

    $scope.submit_login = function(){
        var role = 'user';
        var email = $scope.user.email;
        var password = $scope.user.password;

        //validation
        if(email == ''){
            $scope.error_msg = 1;
            $scope.error_msg_text = 'Email field is required';
            return false;
        }
        else if(password == ''){
            $scope.error_msg = 1;
            $scope.error_msg_text = 'Password field is required';
            return false;
        }
        $http({
            data: {
                role: role,
                email: email,
                password: password
            },
            method : "POST",
            url : "auth/login"
        })
        .success(function(response){
            if(response.success == 1){
                AuthService.auth_check('user').then(
                    function(response){
                        if(response.data.success == 1){
                            $rootScope.is_logedin = 1;
                        }
                        else{
                            $rootScope.is_logedin = 0
                        }
                    }
                );
            }
            else{
                if(response.success == 0){
                    $scope.error_msg = 1;
                    $scope.error_msg_text = 'Incorrect Username/Password';
                }
            }
        })
    }

        $scope.errorMessages = function (errors) {
            var data = "";
            angular.forEach(errors, function (value, key) {
                data += value + "<br/>";
            }, data);
            toastr.error(data, 'Error');
        }


    $scope.animationsEnabled = true;
    $scope.open = function (size) {
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            templateUrl: 'myModalContent.html',
            controller: 'StripeModalInstanceCtrl',
            size: size,
        });

        modalInstance.result.then(function (selectedItem) {
            console.log('stripe');
            $scope.stripeToken = selectedItem;
            $scope.registerOrder();
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };

}]);
//4242424242424242