/**
 * Created by entony on 10/03/16.
 */
App.controller('NewsController', ['$scope', 'news', function ($scope, news) {


    var loadContents = (function () {
        news.getNews().then( function (result) {
            var response = result;
            var newsList = response.posts;
            var index = 0;
            _.each(newsList, function (news) {
                var date = new Date(news.date.replace(" ", "T"));
                var day = date.getDate() >= 10 ? date.getDate() : '0' + date.getDate();
                var month = date.getMonth() >= 10 ? date.getMonth() : '0' + date.getMonth();
                var year = date.getFullYear();
                news.date = day + '/' + month + '/' + year;
                if(index % 10 === 0) {
                    var page = {
                        newsList:[]
                    };
                    $scope.newsPages.push(page);
                }
                $scope.newsPages[$scope.newsPages.length - 1].newsList.push(news);
                index++;
            });
        })
    });

    loadContents();

    $scope.newsPages = [];

    $scope.newsSelectedPage = 0;

    console.log("Loaded news controller");

}]);