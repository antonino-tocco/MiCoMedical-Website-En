/**
 * Created by entony on 02/02/16.
 */
App.controller('AssistanceController', ['$scope', 'productCategories', 'products', 'location', function ($scope, productCategories, products, location) {

    jQuery(document).ready( function () {
        jQuery('.checkbox').bootstrapSwitch();
        jQuery('#assistanceForm').submit(function (event) {
            event.preventDefault();
        });
    });

    var getProvinces = function () {
        if($scope.assistanceRequest.selectedRegion) {
            $scope.provinces = location.getProvinces($scope.assistanceRequest.selectedRegion);
        }
    };

    var getTowns = function () {
        if($scope.assistanceRequest.selectedProvince) {
            $scope.towns = location.getTowns($scope.assistanceRequest.selectedProvince);
        }
    };

    var getCap = function () {
        if($scope.assistanceRequest.selectedTown) {
            $scope.assistanceRequest.cap = location.getCap($scope.assistanceRequest.selectedTown);
        }
    };

    $scope.listCategories = [];

    $scope.listTools = [];

    $scope.regions = [
        {
            nome: 'Seleziona una regione',
            province: []
        }
    ];

    $scope.provinces = [
        {
            nome: 'Seleziona una provincia',
            citta: ''
        }
    ];

    $scope.towns = [
        {
            nome: 'Seleziona un comune',
            cap: ''
        }
    ];

    $scope.tools = [
        {
            name: 'Seleziona un apparecchio'
        }
    ];

    $scope.interventions = [
        {
            name: 'Seleziona un intervento',
        },
        {
            name: 'Riparazione'
        }
    ];

    $scope.assistanceRequest = {};

    $scope.assistanceForm = {};


    $scope.$watch("assistanceRequest.selectedRegion", getProvinces);

    $scope.$watch("assistanceRequest.selectedProvince", getTowns);

    $scope.$watch("assistanceRequest.selectedTown", getCap);

    $scope.$watch("assistanceForm", function () {
        console.log($scope.assistanceForm);
    });

    $scope.sendRequest = function () {
        console.log('Send request');
        var assistanceRequest = $scope.assistanceRequest;
        assistanceRequest.selectedRegion = $scope.assistanceRequest.selectedRegion.nome;
        assistanceRequest.selectedProvince = $scope.assistanceRequest.selectedProvince.nome;
        assistanceRequest.selectedTown = $scope.assistanceRequest.selectedTown.nome;
        console.log(assistanceRequest)
        jQuery.ajax({
            method: 'POST',
            url: '/wp-content/themes/clinico/async/send_assistance_request.php',
            data: {
                'assistanceRequest': assistanceRequest
            },
            dataType: 'json'
        }).then( function (data) {
            console.log(data);
        });
    };

    location.getRegion().then(function (data) {
        $scope.regions = $scope.regions.concat(data);
        console.log($scope.regions);
    });

    products.getAll().then(function (data) {
        if(data.errorCode === 'OK') {
            $scope.tools = $scope.tools.concat(data.tools);
        }
    });



    productCategories.getAll().then( function (data) {
        if(data.errorCode === 'OK') {
            $scope.listCategories = data.toolCategories;
        }
    });

}]);