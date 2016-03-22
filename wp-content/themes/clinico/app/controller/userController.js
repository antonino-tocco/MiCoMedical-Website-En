/**
 * Created by entony on 02/12/15.
 */
App.controller('UserController', [ '$scope','user','regions','provinces','towns','postCode',function ($scope, user, regions,provinces,towns,postCode) {

    jQuery('#registerForm').submit( function (event) {
        event.preventDefault();
    });

    $scope.regions = [{id: '',name: 'Seleziona una regione...'}];

    $scope.provinces = [{id: '',name: 'Seleziona una provincia...'}];

    $scope.towns = [{id: '',name: 'Seleziona un comune...'}];

    $scope.postCode = '';

    $scope.currentRegion = $scope.regions[0];

    $scope.currentProvince = $scope.provinces[0];

    $scope.currentTown = $scope.towns[0];

    $scope.currentPostCode = $scope.postCode;

    $scope.processedForm = false;


    regions.getAll().then(function (data) {
        if(data.errorCode == 'OK') {
            $scope.regions = [{id: '',name: 'Seleziona una regione...'}].concat(data.regions);
            $scope.currentRegion = $scope.regions[0];
        }
    });

    $scope.register = function () {
        var data = jQuery('#registerForm').serializeJSON();
        $scope.processedForm = true;
        user.registerUser(data).then(function (result) {
            $scope.message = result.message;
            $scope.cls = result.cls;
            if(result.errorCode === 'OK') {
                swal({
                    title: 'SUCCESSO!',
                    text: $scope.message,
                    type: 'success'
                });
            } else {
                swal({
                    title: 'ERRORE!',
                    text: $scope.message,
                    type: 'danger'
                });
            }
            $scope.processedForm = false;
            $timeout(function () {
                $scope.$apply();
            })
        });

    };

    $scope.onRegionChange = function () {
        var data = {
            region: $scope.currentRegion
        };
        provinces.getByRegion(data).then(function (result) {
           if(result.errorCode == 'OK') {
               $scope.provinces = [{id: '',name: 'Seleziona una provincia...'}].concat(result.provinces);
               $scope.towns = [{id: '',name: 'Seleziona un comune...'}];
               $scope.postCode = '';
           }
        });
    };

    $scope.onProvinceChange = function () {
        var data = {
            province: $scope.currentProvince
        };
        towns.getByProvince(data).then(function (result) {
            if(result.errorCode == 'OK') {
                $scope.towns = [{id: '',name: 'Seleziona un comune...'}].concat(result.towns);
                $scope.postCode = '';
            }
        });
    };

    $scope.onTownChange = function () {
        var data = {
            town: $scope.currentTown
        };
        postCode.getByTown(data).then(function(result) {
           if(result.errorCode == 'OK') {
               $scope.postCode = result.post_code;
               $scope.$apply();
           }
        });
    };

}]);