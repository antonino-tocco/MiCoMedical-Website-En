/**
 * Created by entony on 20/11/15.
 */
App.controller('MapController', ['$scope','regions',function ($scope,regions) {

    $scope.regions = [];

    $scope.regionsColor = {};

    $scope.markers = [];

    var geocoder = new google.maps.Geocoder();

    regions.getByDistributorPresence().then(function (result) {
        if(result.errorCode == 'OK') {
            result.regions.forEach( function (item) {
                $scope.regions.push(item);
                var code = item.code;
                var distributorList = '';
                _.each(item.associatedUsers, function (user) {
                    distributorList += user.name + '<br />';
                });
                var region = item.name;
                var province = item.associatedUsers[0].province.name;
                var town = item.associatedUsers[0].town.name;
                var address = item.associatedUsers[0].address;
                var format_address = region;
                geocoder.geocode({address: format_address},function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        var lat = results[0].geometry.location.lat();
                        var lng = results[0].geometry.location.lng();
                    }
                    $scope.$apply();
                });
                $scope.regionsColor[code] = '#4DB1E2';
            });
            var map = new jvm.Map({
                map: 'it_regions_mill',
                container: jQuery('#map-italy'),
                backgroundColor: 'transparent',
                //markers: $scope.markers,
                zoomOnScroll: false,
                regionStyle: {
                    initial: {
                        "fill": 'rgba(37,151,222,0.25)',
                        "fill-opacity": 1,
                        "stroke": '#CCC',
                        "stroke-width": 2,
                        "stroke-opacity": 1
                    },
                    hover: {
                        "fill-opacity": 0.8
                    }
                },
                series: {
                    regions: [{
                        attribute: 'fill'
                    }]
                },/*
                labels: {
                    markers: {
                        render: function(index) {
                            return $scope.markers[index].name;
                        },
                        offsets: function(index) {
                            var offset = $scope.markers[index]['offsets'] || [0, 0];

                            return [offset[0] - 7, offset[1] + 3];
                        }
                    }
                },
                markersSelectable: true,
                markerStyle: {
                    initial: {
                        image: "http://46.252.150.202/wp-content/themes/clinico/img/marker.png",
                    },
                },*/
                onRegionTipShow: function(event, label, code){
                    var selectedItem = _.find($scope.regions,(function (item) {
                        return item.code == code;
                    }));
                    var htmlString = '';
                    if(selectedItem && selectedItem.associatedUsers) {
                        _.each(selectedItem.associatedUsers, function (user) {
                            htmlString += user.name + '\n';
                        });
                        label.html(htmlString);
                    }
                    //label.html(item.users[0].name + '<br />' + item.users[0].address + '<br />' + item.users[0].town.name + ',' +item.users[0].postCode + ',' + item.users[0].province.name);
                },/*
                onMarkerClick: function(event, code) {
                    var selectedItem = _.find($scope.regions,(function (item) {
                        return item.code == code;
                    }));
                    var htmlString = '';
                    if(selectedItem && selectedItem.associatedUsers) {
                        _.each(selectedItem.associatedUsers, function (user) {
                            htmlString += user.name + '\n';
                        });
                    }
                }*/
            });
            map.series.regions[0].setValues($scope.regionsColor);
        }
    });
}]);