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
        
        updateCaterer:function(data){
            return $http({
                data:data,
                method: "post",
                url: "caterer/settings/update"
            });
        },

        getPackages: function () {
            return $http({
                method: "get",
                url: "caterer/product/package"
            });
        },

        getPackage: function (package_id) {
            return $http({
                method: "get",
                url: "caterer/product/package/" + package_id
            });
        },

        changeStatus: function (order) {
            return $http({
                data: order,
                method: "post",
                url: "caterer/order/change-status"
            });
        },

        create: function (data) {
            return $http({
                data: data,
                method :"post",
                url : "caterer/product/package"
            });
        },

        updatePackgeCommonInf: function (data,package_id) {
            return $http({
                data: data,
                method: "put",
                url: "caterer/product/package/" + package_id
            });
        },

        getAddingProducts: function(package_id){
            return $http({
                method: "get",
                url: "caterer/product/package/"+ package_id +"/edit"
            });
        },

        updateProductCount: function (data) {
            return $http({
                data: data,
                method: "post",
                url: "caterer/product/package/editcount"
            });
        },

        addProdcuts: function (package_id,data) {
            return $http({
                data: data,
                method: "post",
                url: "caterer/product/package/addProduct/" + package_id
            });
        },

        removeProductFromPackage: function (data) {
            return $http({
                data: data,
                method: "post",
                url: "caterer/product/package/removeProduct"
            });
        },


        getAllProducts: function (){
            return $http({
                method :"post",
                url : "caterer/product/package/getAllProducts"
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


        addDeliveryArea: function(zip_codes){
            return $http({
                data: zip_codes,
                method :"post",
                url : "caterer/settings/addDeliveryArea"
            });
        },

        removeDeliveryArea: function (zip_id){
            return $http({
                method :"get",
                url : "caterer/settings/removeDeliveryArea/" + zip_id
            });
        },

        editCookingTime: function (data) {
            return $http({
                data: data,
                method :"post",
                url : "caterer/settings/editCookingTime"
            });
        },
        
        getAllZips: function ()
        {
            return $http({
                method : "get",
                url : "order/getAllZips"
            })
        },

        addKitchen: function(data){
            return $http({
                data:data,
                method :"post",
                url : "caterer/settings/addKitchen"
            });
        },

        removeKitchen: function (kitchen_id){
            return $http({
                method :"get",
                url : "caterer/settings/removeKitchen/" + kitchen_id
            });
        },

        changePassword:function(data){
            return  $http({
                data: data,
                method : "post",
                url : "caterer/settings/changePassword"
            });
        },

        deletePackage: function (package_id) {
            return $http({
                method :"get",
                url : "caterer/product/package/delete/" + package_id
            });
        }

    };
}]);
