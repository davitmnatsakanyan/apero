app.controller('OrderController', ['$scope', function ($scope) {
    
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
    //$scope.datas = [
    //    {type: 'text', class: 'form-group', label: 'Firma', placeholder: 'Arnold', test: 'firma'},
    //    {type: 'text', class: 'form-group', label: 'Vorname', placeholder: 'Tempees', test: 'vorname'},
    //    {type: 'text', class: 'form-group', label: 'Names', placeholder: 'Vorname', test: 'names'},
    //    {type: 'text', class: 'form-group', label: 'Strasse', placeholder: 'Lorem Ipsum', test: 'strasse'},
    //    {type: 'email', class: 'form-group', label: 'PLZ', placeholder: 'tempees@tempees.com', test: 'plz'},
    //    {type: 'text', class: 'form-group', label: 'ort', placeholder: 'Fifth Avenue', test: 'ort'},
    //];

    $scope.change = function(){
        if($scope.other_address){
            $('.last').after(
                '<div class="form-group billing_address">'+
                    '<label for="">address</label>'+
                    '<input type="text"  class="form-control"  placeholder="address" ng-model="billing_address">'+
                '</div>'
            );
        }
        else{
            $('.billing_address').html('');
        }
    }

    $scope.payment = {
        name: 'cash'
    }
    $scope.submitOrder = function(){
        var products = JSON.parse(localStorage.getItem('cart'));
        var delivery_address = $scope.address+' '+ $scope.home;
        var delivery_zip = $scope.delivery_zip;
        var email = $scope.email;
        var mobile = $scope.mobile;
        var phone = $scope.phone;
        var billing_address  =$scope.billing_address;
        var payment_type = $scope.payment.name;
        var comment = $scope.comment;


        var data =  {
            products : products,
                delivery_address : delivery_address,
                delivery_zip : delivery_zip,
                email: email,
                mobile : mobile,
                phone: phone,
                billing_address : billing_address,
                payment_type : payment_type,
                comment : comment
        };
        console.log(data);
        $http({
                data: {
                    products : products,
                    delivery_address : delivery_address,
                    delivery_zip : delivery_zip,
                    email: email,
                    mobile : mobile,
                    phone: phone,
                    billing_address : billing_address,
                    payment_type : payment_type,
                    comment : comment
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

}]);
