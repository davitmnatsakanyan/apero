app.controller('EditProductController', ['$scope', 'CatererProductModel', 'CatererAccountModel', 'AuthService', '$location', '$uibModal', '$routeParams', 'toastr',
    function ($scope, CatererProductModel, CatererAccountModel, AuthService, $location, $uibModal, $routeParams, toastr) {

        AuthService.auth('caterer');

        CatererAccountModel.getAccount().then(function (response) {
            if (response.data.success) {
                $scope.caterer = response.data.caterer;
            }
        });
        $scope.getPrDts = function() {
            if ($routeParams.product_id) {
                var product_id = $routeParams.product_id;
                CatererProductModel.getProduct(product_id).then(
                    function (response) {
                        $scope.product = response.data.product;
                        // $scope.product.customize = [];
                        $scope.product.kitchen = {
                            name: $scope.product.kitchen.name,
                            id: $scope.product.kitchen.id,
                        }

                        $scope.product.menu = {
                            name: $scope.product.menu.name,
                            id: $scope.product.menu.id,
                        }
                        $scope.allKitchens = [];
                        $scope.allMenus = [];


                        $scope.currentSubproductsPage = 1;
                        $scope.numPerPageForSubproducts = 10;
                        $scope.subproductsMaxSize = 5;
                        $scope.filteredSubproducts = $scope.product.subproducts.slice(0, $scope.numPerPageForSubproducts);


                        CatererProductModel.getAllKitchens().then(function (response) {
                            for (kitchen in response.data.kitchens)
                                $scope.allKitchens.push({
                                    name: response.data.kitchens[kitchen].name,
                                    id: response.data.kitchens[kitchen].id,
                                });
                        });

                        CatererProductModel.getAllMenus($scope.product.kitchen.id).then(
                            function (response) {
                                for (menu in response.data.menus)
                                    $scope.allMenus.push({
                                        name: response.data.menus[menu].name,
                                        id: response.data.menus[menu].id,
                                    });
                            }
                        );
                    }
                );
            }

            // $scope.addSubproducts = function(){
            //     CatererProductModel.addSubproducts({customize:$scope.customize, id:$scope.product.id}).then(
            //         function(response){
            //             if(response.data.success){
            //                 $scope.product.subproducts = response.data.subproducts;
            //                 $scope.customize =[];
            //                 $scope.changeSubproduct();
            //                 toastr.success(response.data.message);
            //             }
            //
            //             else{
            //                 toastr.error(response.data.error,"Error");
            //             }
            //         },
            //         function(error){
            //             $scope.errorMessages(error.data);
            //         }
            //     );
            // }
        }
        if (!$scope.customize) {
            $scope.customize = [{
                name: "",
                price: ""
            }]

            $scope.currentCustomizePage = 1;
            $scope.numPerPageForCustomize = 5;
            $scope.customizeMaxSize = 5;
            $scope.filteredCustomize = $scope.customize.slice(0, $scope.numPerPageForCustomize);
        }


        $scope.addCustomize = function () {
            $scope.customize.push({
                name: "",
                price: ""
            });
            $scope.changeCustomize();
        }

        $scope.changedCustomize = 0;

        $scope.changeCustomize = function () {
            if ($scope.changedCustomize)
                $scope.changedCustomize = 0;
            else
                $scope.changedCustomize = 1
        }

        $scope.changedSubproduct = 0;

        $scope.changeSubproduct = function () {
            if ($scope.changedSubproduct)
                $scope.changedSubproduct = 0;
            else
                $scope.changedSubproduct = 1
        }

        $scope.remove = function (index) {
            $scope.customize.splice(index, 1);
            $scope.changeCustomize();
        },

            $scope.selectKitchenForEdit = function (selected, $model) {
                $scope.product.kitchen = $model;
                CatererProductModel.getAllMenus($model.id).then(
                    function (response) {
                        $scope.allMenus = [];
                        for (menu in response.data.menus)
                            $scope.allMenus.push({
                                name: response.data.menus[menu].name,
                                id: response.data.menus[menu].id,
                            });
                    });

            }

        $scope.removeSubproduct = function (subrpoduct_id) {
            CatererProductModel.removeSubproduct(subrpoduct_id).then(
                function (response) {
                    if (response.data.success) {
                        var removed = $scope.product.subproducts.find(function (subrpoduct) {
                            return subrpoduct.id == subrpoduct_id;
                        }, subrpoduct_id);

                        $scope.product.subproducts.splice($scope.product.subproducts.indexOf(removed), 1);
                        $scope.changeSubproduct();
                        toastr.success(response.data.message);
                    }
                    else {
                        toastr.error(response.data.error, 'Error')
                    }
                },
                function (error) {
                    $scope.errorMessages(error.data);
                }
            );
        }


        $scope.addSubproducts = function () {
            CatererProductModel.addSubproducts({customize: $scope.customize, id: $scope.product.id}).then(
                function (response) {
                    if (response.data.success) {
                        $scope.product.subproducts = response.data.subproducts;

                        $scope.customize = [];
                        $scope.customize. push({
                            name: "",
                            price: ""
                        });
                        $scope.changeSubproduct();
                        $scope.changeCustomize();
                        toastr.success(response.data.message);
                    }

                    else {
                        toastr.error(response.data.error, "Error");
                    }
                },
                function (error) {
                    $scope.errorMessages(error.data);
                }
            );
        }

        $scope.$watchGroup(['currentCustomizePage', 'changedCustomize', 'currentSubproductsPage', 'product.subproducts.length','changedSubproduct'],
            function (newValues, oldValues, scope) {

                var last_changed,last_changed1;
                if (newValues[0] != oldValues[0] || newValues[1] != oldValues[1])
                    last_changed1 = 'currentCustomize';
                if (newValues[2] != oldValues[2] || newValues[3] != oldValues[3]|| newValues[4] != oldValues[4])
                    last_changed = 'currentSubproducts';

                if (angular.isDefined(last_changed) || angular.isDefined(last_changed1)) {
                    if (last_changed1  == 'currentCustomize') {
                        var begin = (($scope.currentCustomizePage - 1) * $scope.numPerPageForCustomize), end = begin + $scope.numPerPageForCustomize;
                        $scope.filteredCustomize = $scope.customize.slice(begin, end);
                    }

                    if (last_changed == 'currentSubproducts') {
                        var begin = (($scope.currentSubproductsPage - 1) * $scope.numPerPageForSubproducts), end = begin + $scope.numPerPageForSubproducts;
                        $scope.filteredSubproducts = $scope.product.subproducts.slice(begin, end);
                    }
                }


            });

        $scope.isActive = function (viewLocation) {
            // return $location.path().indexOf(viewLocation) == 0;
            return viewLocation === $location.path();
        };

        $scope.errorMessages = function (errors) {
            var data = "";
            angular.forEach(errors, function (value, key) {
                data += value + "<br/>";
            }, data);
            toastr.error(data, 'Error');
        }


        $scope.animationsEnabled = true;
        $scope.open = function (size, subpoduct_id) {

            var updated = $scope.product.subproducts.find(function (subpoduct) {
                return subpoduct.id == subpoduct_id;
            }, subpoduct_id);

            var modalInstance = $uibModal.open({
                animation: $scope.animationsEnabled,
                templateUrl: 'myModalContent.html',
                controller: 'SubproductModalInstanceCtrl',
                size: size,
                resolve: {
                    subproduct: function () {
                        return updated;
                    }
                }
            });

            modalInstance.result.then(function (subproduct) {
                CatererProductModel.updateSubproduct(subproduct).then(
                    function (response) {
                        if (response.data.success) {
                            $scope.product.subproducts[$scope.product.subproducts.indexOf(updated)] = subproduct;
                            toastr.success(response.data.message);
                        }
                        else {
                            toastr.error(response.data.error, "Error");
                        }
                    },
                    function (error) {
                        $scope.errorMessages(error.data);
                    }
                );
            }, function () {
                console.log('Modal dismissed at: ' + new Date());
            });
        };

        $scope.updateProduct = function ($files, $event, $flow) {
            $flow.opts.target = "caterer/product/single/image/" + $scope.product.id;
            $flow.upload();

            CatererProductModel.updateProduct($scope.product).then(
                function (response) {
                    if (response.data.success) {
                        toastr.success(response.data.message);
                    }
                    else {
                        toastr.error(response.data.error, "Error");
                    }
                },
                function (error) {
                    $scope.errorMessages(error.data);
                }
            );
        }
    }]);
