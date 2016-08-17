app.factory('CatererProductModel', ['$http', function ($http) {
    return {
        getKitchens: function () {
            return $http({
                method: "get",
                url: "caterer/product/single/kitchens"
            });
        },

        getMenus: function (kitchen_id) {
            return $http({
                method: "get",
                url: "caterer/product/single/menus/" + kitchen_id
            });
        },

         getProducts: function (kitchen_id,menu_id){
             return $http({
                 method: "get",
                 url: "caterer/product/single/products/" + kitchen_id + "/" + menu_id
             });
         },

        getProduct: function (product_id){
            return $http({
                method: "get",
                url: "caterer/product/single/view/" + product_id
            });
        },
        

        changeStatus: function (order) {
            return $http({
                data: order,
                method: "post",
                url: "caterer/order/change-status"
            });
        },
        
        getAllKitchens: function (){
            return $http({
                method:'get',
                url:'caterer/product/single/getAllKitchens'
            })
        },

        getAllMenus: function (kitchen_id){
            return $http({
                method:'get',
                url:'caterer/product/single/getAllMenus/' + kitchen_id
            })
        },

        createProduct: function(data){
            return $http({
                data:data,
                method:'post',
                url:'caterer/product/single/add'
            })
        },

        addSubproducts: function(data){
            return $http({
                data:data,
                method:'post',
                url:'caterer/product/single/addSubproducts'
            })
        },

        removeSubproduct: function (subrpoduct_id){
            return $http({
                method:'get',
                url:'caterer/product/single/deleteSubproduct/' + subrpoduct_id
            })
        },

        updateSubproduct:function (data){
            return $http({
                data:data,
                method:'post',
                url:'caterer/product/single/updateSubproduct'
            })
        },
        
        updateProduct:function(data){
            return $http({
                data:data,
                method:'post',
                url:'caterer/product/single/update'
            })
        },

        deleteProduct:function (product_id) {
            return $http({
                method:'get',
                url:'caterer/product/single/delete/' + product_id
            })
        }
        
        
        
        

    };
}]);
