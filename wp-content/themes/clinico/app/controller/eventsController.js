/**
 * Created by entony on 10/03/16.
 */
App.controller('EventsController', ['$scope', 'events', function ($scope, events) {


    var loadContents = (function () {
        events.getEvents().then( function (result) {
            var response = result;
            var eventsList = response.posts;
            var index = 0;
            _.each(eventsList, function (event) {
                var date = new Date(event.date.replace(" ", "T"));
                var day = date.getDate() >= 10 ? date.getDate() : '0' + date.getDate();
                var month = date.getMonth() >= 10 ? date.getMonth() : '0' + date.getMonth();
                var year = date.getFullYear();
                event.date = day + '/' + month + '/' + year;
                if(index % 10 === 0) {
                    var page = {
                        eventsList: []
                    };
                    $scope.eventsPages.push(page);
                }
                $scope.eventsPages[$scope.eventsPages.length - 1].eventsList.push(event);
                index++;
            });
        })
    });

    loadContents();

    $scope.eventsPages = [];

    $scope.eventsSelectedPage = 0;

    console.log("Loaded events controller");


}]);