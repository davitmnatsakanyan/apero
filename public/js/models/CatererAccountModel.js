app.factory('CatererAccountModel', ['$http', function ($http) {
    return {
        getAccount: function () {
            return $http({
                method: "get",
                url: "caterer/account"
            });
        },

        getRegister: function () {
            return $http({
                method: "get",
                url: "auth/register"
            });
        },

        getOrders: function () {
            return $http({
                method: "get",
                url: "caterer/order"
            });
        },
        getOrder: function (order_id) {
            return $http({
                method: "get",
                url: "caterer/order/show/" + order_id
            });
        },

        getProducts: function () {
            return $http({
                method: "get",
                url: ""
            });
        },

        changeStatus: function (order) {
            return $http({
                data: order,
                method: "post",
                url: "caterer/order/change-status"
            });
        },

        acceptOrder: function(order_id){
            return $http({
                method :"get",
                url : "caterer/order/accept/" + order_id
            });
        },
        
        updateContactPerson: function(contact_person){
            return $http({
                data: contact_person,
                method :"post",
                url : "caterer/settings/updateContactPerson"
            });
        },

        removeDeliveryArea: function (zip_id){
            return $http({
                method :"get",
                url : "caterer/settings/removeDeliveryArea/" + zip_id
            });
        }
    };
}]);
