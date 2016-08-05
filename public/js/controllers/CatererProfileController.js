app.controller('CatererProfileController', ['$scope', 'CatererAccountModel', '$window', 'AuthService', '$location',
    'toastr', 'ModalService',
    function ($scope, CatererAccountModel, $window, AuthService, $location, toastr, ModalService) {

        AuthService.auth('caterer');

        CatererAccountModel.getAccount().then(function (response) {
            if (response.data.success) {
                $scope.caterer = response.data.caterer;
                $scope.contact_person = response.data.caterer.contact_person;

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
                $scope.filteredZips = $scope.caterer_zips.slice(0, $scope.numPerPageForProducts);

                var zips = response.data.zip_codes;
                $scope.zip_codes = [];
                for (zip in zips) {
                    $scope.zip_codes.push({
                        id: zips[zip].id,
                        name: zips[zip].ZIP + " " + zips[zip].city
                    })
                }
                ;


                $scope.cooking_time = response.data.caterer.cookingtime;
                $scope.changeZip();

            }
        }, function (error) {
            console.log(error);
        });

        $scope.selectedZipCodes = [];

        $scope.isActive = function (viewLocation) {
            return viewLocation === $location.path();
        };

        $scope.updateContactPerson = function () {
            CatererAccountModel.updateContactPerson($scope.contact_person).then(function (response) {
                if (response.data.success) {
                    toastr.success(response.data.message);
                }
                else {
                    toastr.error(responce.data.error, 'Error');
                }
            }, function (error) {
                $scope.errorMessages(error.data);
            });
        }


        $scope.errorMessages = function (errors) {
            var data = "";
            angular.forEach(errors, function (value, key) {
                data += value + "<br/>";
            }, data);
            toastr.error(data, 'Error');
        }

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
            console.log($scope.selectedZipCodes);
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

        $scope.changedZip = 0;

        $scope.changeZip = function () {
            if ($scope.changedZip)
                $scope.changedZip = 0;
            else
                $scope.changedZip = 1;
        }

        $scope.addZipToSelect = function ($item, $model) {
            $scope.selectedZipCodes.push($model);
        }

        $scope.removeZipFromSelect = function ($item, $model) {
            var removed = $scope.selectedZipCodes.find(function (zip) {
                return zip.id == $model.id;
            }, $model);
            $scope.selectedZipCodes.splice($scope.selectedZipCodes.indexOf(removed), 1);
        }


        $scope.$watchGroup(['currentZipsPage', 'changedZip'], function (newValues, oldValues, scope) {

            var last_changed;
            if (newValues[0] != oldValues[0])
                last_changed = 'currentZipsPage';
            if (newValues[1] != oldValues[1])
                last_changed = 'changedZip';

            if (angular.isDefined(last_changed)) {
                if (last_changed == 'currentZipsPage' || last_changed == 'changedZip') {
                    var begin = (($scope.currentZipsPage - 1) * $scope.numPerPageForZips), end = begin + $scope.numPerPageForZips;
                    $scope.filteredZips = $scope.caterer_zips.slice(begin, end);
                }
            }


        });


        $scope.showEditCookingTime = function (group, time) {

            $scope.editCooking = {group: group, time: time};
            ModalService.showModal({
                templateUrl: "/templates/caterer/account/modals/cooking_time.blade.php",
                controller: "CatererProfileController",
                scope: $scope
            }).then(function (modal) {
                modal.element.modal();
                console.log(22);
                modal.close.then(function (result) {
                    console.log(12)

                    // $scope.yesNoResult = result ? "You said Yes" : "You said No";
                });
                console.log(33);
            });

        };

        $scope.myclose = function (result) {
            if (result) {
                CatererAccountModel.editCookingTime($scope.editCooking).then(function (response) {
                    if (response.data.success) {
                        var group = $scope.editCooking.group;
                        $scope.cooking_time[group] = parseInt($scope.editCooking.time);
                        console.log( $scope.cooking_time);
                        toastr.success(response.data.message);
                    }
                    else {
                        toastr.error(response.data.error, 'Error');
                    }
                }, function (error) {
                    $scope.errorMessages(error.data);
                });
            }
            close(result, 500); // close, but give 500ms for bootstrap to animate
        };




    }]);
