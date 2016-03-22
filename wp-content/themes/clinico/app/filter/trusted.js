/**
 * Created by entony on 26/01/16.
 */
App.filter('trusted', ['$sce', function ($sce) {
    return function(text) {
        return $sce.trustAsHtml(text);
    };
}]);