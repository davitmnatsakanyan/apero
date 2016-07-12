app.controller('OrderController', [ '$rootScope', '$scope', '$http', 'AuthService', function ( $rootScope, $scope, $http, AuthService) {

    $('#datetimepicker4').datetimepicker();

    $scope.orders = JSON.parse(localStorage.getItem('cart'));
    if(localStorage.getItem('total_price'))
        $scope.total_price = localStorage.getItem('total_price');
    else
        $scope.total_price = 0;

    var new_total_price;
    $scope.removeFromCart = function(index, total_price){

        $products = JSON.parse(localStorage.getItem('cart'));

        new_total_price = total_price -  ($products[index].price * $products[index].count);
        localStorage.setItem('total_price', new_total_price);
        $scope.total_price = new_total_price;

        $products.splice(index, 1);

        localStorage.setItem('cart', JSON.stringify( $products));
        $scope.orders = $products;

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
        var products = JSON.parse(localStorage.getItem('cart'));
        var delivery_address = $scope.address+' '+ $scope.home;
        var delivery_zip = $scope.delivery_zip;
        var email = $scope.email;
        var mobile = $scope.mobile;
        var phone = $scope.phone;
        var billing_address  =$scope.billing_address;
        var payment_type = $scope.payment.name;
        var comment = $scope.comment;
        var is_logedin = $rootScope.is_logedin;


        var data =  {
                company :           company,
                products :          products,
                delivery_country :  delivery_country,
                delivery_city :     delivery_city,
                products :          products,
                delivery_address :  delivery_address,
                delivery_zip :      delivery_zip,
                email:              email,
                mobile :            mobile,
                phone:              phone,
                billing_address :   billing_address,
                payment_type :      payment_type,
                comment :           comment,
                is_logedin :        is_logedin
        };
        console.log(data);
        $http({
                data: {
                    company :           company,
                    delivery_country :  delivery_country,
                    delivery_city :     delivery_city,
                    products :          products,
                    delivery_address :  delivery_address,
                    delivery_zip :      delivery_zip,
                    email:              email,
                    mobile :            mobile,
                    phone:              phone,
                    billing_address :   billing_address,
                    payment_type :      payment_type,
                    comment :           comment,
                    is_logedin :        is_logedin
                },
                method : "POST",
                url : "order"
            }
        ).success(function (response) {
                if(response.success == 1){
                    alert('order submitted')
                }
            }).error( function (error) {
                console.log(error);

            });
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
                AuthService.auth_check();
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
