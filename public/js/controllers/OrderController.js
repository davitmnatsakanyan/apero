app.controller('OrderController', [ '$rootScope', '$scope', '$http', 'AuthService', function ( $rootScope, $scope, $http, AuthService) {

    $('#datetimepicker4').datetimepicker();

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

    $scope.change = function(){
        if($scope.is_different)
            $scope.is_different = false;
        else
            $scope.is_different = true;

    }

    $scope.payment = {
        name: 'cash'
    }
    $scope.submitOrder = function(){
        var company = $scope.company;
        var delivery_country = $scope.country;
        var delivery_city = $scope.city;
        var orders = JSON.parse(localStorage.getItem('cart'))[0];
        var delivery_address = $scope.address+' '+ $scope.home;
        var delivery_zip = $scope.delivery_zip;
        var email = $scope.email;
        var mobile = $scope.mobile;
        var phone = $scope.phone;
        var billing_address  =$scope.billing_address;
        var payment_type = $scope.payment.name;
        var comment = $scope.comment;
        var is_logedin = $rootScope.is_logedin;
        var is_accepted = $scope.is_accepted;


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
        };
        console.log(data);
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
                is_accepted:        is_accepted
            },
            method : "POST",
            url : "order"
        })
        .success(function (response) {
            if(response.success == 1){
                alert('order submitted')
            }
        })
        .error( function (error) {
            console.log(error);

        });
    };

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

}]);
