app.controller('CatererProfileController', ['$scope', 'CatererAccountModel','$window', 'AuthService', '$location', '$uibModal', '$routeParams', 'toastr',
    function ($scope, CatererAccountModel, $window, AuthService,$location,$uibModal, $routeParams, toastr ) {

        AuthService.auth('caterer');
        $scope.expression = function () {
            console.log('change');
        }
        
        $scope.getAccount = function () {
            CatererAccountModel.getAccount().then(function (response) {
                if (response.data.success) {
                    $scope.caterer = response.data.caterer;
                    $scope.contact_person = response.data.caterer.contact_person;
                    $scope.countries = response.data.countries;
                    $scope.selectedCountry = $scope.caterer.caterer_country;

                    $scope.zips = response.data.zips;
                    $scope.selectedZip = $scope.caterer.caterer_zip;

                    var caterer_zips = response.data.caterer.zips;
                    $scope.caterer_zips = [];
                    for (var i = 0; i < caterer_zips.length; i++) {
                        $scope.caterer_zips.push({
                            id: caterer_zips[i].id,
                            name: caterer_zips[i].ZIP + " " + caterer_zips[i].city
                        });
                    }

                    $scope.currentZipsPage = 1;
                    $scope.numPerPageForZips = 3;
                    $scope.zipsMaxSize = 5;
                    $scope.filteredZips = $scope.caterer_zips.slice(0, $scope.numPerPageForZips);

                    var zips = response.data.zip_codes;
                    $scope.zip_codes = [];
                    for (zip in zips) {
                        $scope.zip_codes.push({
                            id: zips[zip].id,
                            name: zips[zip].ZIP + " " + zips[zip].city
                        })
                    }
                    var caterer_kitchens = $scope.caterer.kitchens;
                    $scope.kitchens = [];

                    for (var i = 0; i < caterer_kitchens.length; i++) {
                        $scope.kitchens.push({
                            id: caterer_kitchens[i].id,
                            name: caterer_kitchens[i].name
                        });
                    }

                    $scope.currentKitchensPage = 1;
                    $scope.numPerPageForKitchens = 1;
                    $scope.kitchensMaxSize = 5;
                    $scope.filteredKitchens = $scope.kitchens.slice(0, $scope.numPerPageForKitchens);

                    $scope.addingKitchens = [];
                    var addingKitchens = response.data.kitchens;
                    for (kitchen in addingKitchens) {
                        $scope.addingKitchens.push({
                            id: addingKitchens[kitchen].id,
                            name:  addingKitchens[kitchen].name,
                        });
                    }
                    $scope.cooking_time = response.data.caterer.cookingtime;

                }
            }, function (error) {
                console.log(error);
            });
        }

        $scope.selectedZipCodes = [];
        $scope.selectedKitchens = [];
        
        $scope.isActive = function (viewLocation) {
            return viewLocation === $location.path();
        };

        
        $scope.updateContactPerson = function () {
            CatererAccountModel.updateContactPerson($scope.contact_person).then(
                function (response) {
                if (response.data.success) {
                    toastr.success(response.data.message);
                }
                else {
                    toastr.error(responce.data.error, 'Error');
                }
            },
                function (error) {
                $scope.errorMessages(error.data);
            }
            );
        };

        $scope.updateCaterer = function()
        {
            console.log($scope.caterer);
            CatererAccountModel.updateCaterer($scope.caterer).then(
                function (response) {
                    if (response.data.success) {
                        toastr.success(response.data.message);
                    }
                    else {
                        toastr.error(responce.data.error, 'Error');
                    }
                },
                function (error) {
                    $scope.errorMessages(error.data);
                }
            );
        };

        $scope.errorMessages = function (errors) {
            var data = "";
            angular.forEach(errors, function (value, key) {
                data += value + "<br/>";
            }, data);
            toastr.error(data, 'Error');
        };

        $scope.selectZip = function($select, $model)
        {
            $scope.caterer.zip = $model.id;
        };
        
        $scope.selectCountry = function($select, $model)
        {
            $scope.caterer.country = $model.id;
        };


        $scope.removeDeliveryArea = function (zip_id) {
            CatererAccountModel.removeDeliveryArea(zip_id).then(function (response) {
                if (response.data.success) {
                    var removed = $scope.caterer_zips.find(function (zip) {
                        return zip.id == zip_id;
                    }, zip_id);

                    $scope.caterer_zips.splice($scope.caterer_zips.indexOf(removed), 1);
                    $scope.zip_codes.push({id: removed.id, name: removed.name});
                    $scope.changeZip();
                    toastr.success(response.data.message);
                }
                else {
                    toastr.error(response.data.error, 'Error');
                }
            }, function (error) {
                $scope.errorMessages(error.data);
            });
        };

        $scope.addDeliveryArea = function () {
            CatererAccountModel.addDeliveryArea($scope.selectedZipCodes).then(function (response) {
                if (response.data.success) {
                    var bIds = {};
                    $scope.selectedZipCodes.forEach(function (obj) {
                        bIds[obj.id] = obj;
                    });

                    $scope.zip_codes = $scope.zip_codes.filter(function (obj) {
                        return !(obj.id in bIds);
                    });


                    $scope.selectedZipCodes.forEach(function (obj) {
                        $scope.caterer_zips.push(obj);
                    });

                    $scope.selectedZipCodes = [];
                    $scope.changeZip();
                    toastr.success(response.data.message);
                }
                else {
                    toastr.error(response.data.error, 'Error');
                }
            }, function (error) {
                $scope.errorMessages(error.data);
            });
        };


        $scope.removeKitchen = function(kitchen_id){
            CatererAccountModel.removeKitchen(kitchen_id).then(function (response) {
                if (response.data.success) {

                    var removed = $scope.kitchens.find(function (kitchen) {
                        return kitchen.id == kitchen_id;
                    }, kitchen_id);

                    $scope.kitchens.splice($scope.kitchens.indexOf(removed), 1);
                    $scope.addingKitchens.push({id: removed.id, name: removed.name});
                    $scope.changeKitchen();
                    toastr.success(response.data.message);
                }
                else {
                    toastr.error(response.data.error, 'Error');
                }
            }, function (error) {
                $scope.errorMessages(error.data);
            });
        };

        $scope.addKitchens = function () {
            CatererAccountModel.addKitchen($scope.selectedKitchens).then(function (response) {
                if (response.data.success) {
                    var bIds = {};
                    $scope.selectedKitchens.forEach(function (obj) {
                        bIds[obj.id] = obj;
                    });

                    $scope.addingKitchens = $scope.addingKitchens.filter(function (obj) {
                        return !(obj.id in bIds);
                    });


                    $scope.selectedKitchens.forEach(function (obj) {
                        $scope.kitchens.push(obj);
                    });

                    $scope.selectedKitchens = [];
                    $scope.changeKitchen();
                    toastr.success(response.data.message);
                }
                else {
                    toastr.error(response.data.error, 'Error');
                }
            }, function (error) {
                $scope.errorMessages(error.data);
            });
        };

        $scope.changedZip = 0;

        $scope.changeZip = function () {
            if ($scope.changedZip)
                $scope.changedZip = 0;
            else
                $scope.changedZip = 1;
        };

        $scope.changedKitchen = 0;

        $scope.changeKitchen = function () {
            if ($scope.changedKitchen)
                $scope.changedKitchen = 0;
            else
                $scope.changedKitchen = 1;
        };

        $scope.addZipToSelect = function ($item, $model) {
            $scope.selectedZipCodes.push($model);
        };

        $scope.removeZipFromSelect = function ($item, $model) {
            var removed = $scope.selectedZipCodes.find(function (zip) {
                return zip.id == $model.id;
            }, $model);
            $scope.selectedZipCodes.splice($scope.selectedZipCodes.indexOf(removed), 1);
        };

        $scope.addKitchenToSelect = function ($item, $model) {
            $scope.selectedKitchens.push($model);

        };

        $scope.removeKitchenFromSelect = function ($item, $model) {
            var removed = $scope.selectedKitchens.find(function (kitchen) {
                return kitchen.id == $model.id;
            }, $model);
            $scope.selectedKitchens.splice($scope.selectedKitchens.indexOf(removed), 1);
        };


        $scope.$watchGroup(['currentZipsPage', 'changedZip','currentKitchensPage', 'changedKitchen'], function (newValues, oldValues, scope) {

            var last_changed,last_changed1;
            if (newValues[0] != oldValues[0] || newValues[1] != oldValues[1])
                last_changed1 = 'changedZip';
            
            if (newValues[2] != oldValues[2] || newValues[3] != oldValues[3])
                last_changed = 'changedKitchens';

            if (angular.isDefined(last_changed) || angular.isDefined(last_changed1)) {
                if (last_changed1 == 'changedZip') {
                    var begin = (($scope.currentZipsPage - 1) * $scope.numPerPageForZips), end = begin + $scope.numPerPageForZips;
                    $scope.filteredZips = $scope.caterer_zips.slice(begin, end);
                }  
                
                if (last_changed == 'changedKitchens') {
                    var begin = (($scope.currentKitchensPage - 1) * $scope.numPerPageForKitchens), end = begin + $scope.numPerPageForKitchens;
                    $scope.filteredKitchens = $scope.kitchens.slice(begin, end);
                }
            }


        });

        $scope.animationsEnabled = true;
        $scope.open = function (size,group,value) {
            var modalInstance = $uibModal.open({
                animation: $scope.animationsEnabled,
                templateUrl: 'myModalContent.html',
                controller: 'CookingTimeModalInstanceCtrl',
                size: size,
                resolve: {
                data: function () {
                    var data = {
                        group:group,
                        time:value
                    };
                        return data;
                    }
                }
            });

            modalInstance.result.then(function (edit) {
                CatererAccountModel.editCookingTime(edit).then(function (response) {
                        if (response.data.success) {
                            $scope.cooking_time[edit.group] = edit.time;
                            toastr.success(response.data.message);
                        }
                        else {
                            toastr.error(responce.data.error, 'Error');
                        }
                    },
                    function (error) {
                        $scope.errorMessages(error.data);
                    });
                
            }, function () {
               console.log('Modal dismissed at: ' + new Date());
            });
        };

        $scope.changePasswordData = {
            old_password:"",
            password:"",
            password_confirmation:"",
        };
        $scope.changePassword = function () {
            CatererAccountModel.changePassword($scope.changePasswordData).then(
                function (response) {
                    if (response.data.success)
                        toastr.success(response.data.message);
                    else
                        toastr.error(response.data.error, 'Error');
                },

                function (error) {
                    $scope.errorMessages(error.data);
                }
            );
        }

    }]);