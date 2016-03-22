/**
 * Created by entony on 18/11/15.
 */
App.controller('ProductController',['$scope','$q','productCategories','products', function ($scope,$q,productCategories,products){

    $scope.productCategories = [];

    $scope.currentCategory = -1;

    $scope.currentProduct = -1;

    $scope.getImageUrl = function (imagePath, type) {
        switch (type) {
            case 'image':
                return imagePath ? "/area_riservata/web/uploads/images/" + imagePath : "/wp-content/themes/clinico/img/nofoto.jpg";
                break;
            case 'pcImage':
                return imagePath ? "/area_riservata/web/uploads/pc_images/" + imagePath : "/wp-content/themes/clinico/img/nofoto.jpg";
                break;
            case 'supportImage':
                return imagePath ? "/area_riservata/web/uploads/support_images/" + imagePath : "/wp-content/themes/clinico/img/nofoto.jpg";
                break;
            default:
                return "/wp-content/themes/clinico/img/nofoto.jpg";
        }
    };

    $scope.getCategories = function () {
        var deferred = $q.defer();
        productCategories.getAll().then(function (result) {
            if (result.errorCode == 'OK') {
                $scope.productCategories = result.toolCategories;
                deferred.resolve($scope.productCategories);
                $scope.productCategories.forEach(function (item) {
                    var categoryId = item.id;
                    products.getByCategory(categoryId).then(function (result) {
                        if (result.errorCode == 'OK') {
                            item.products = result.tools;
                        }
                    });
                });
            }
        });
        return deferred.promise;
    };

    $scope.getProducts = function (category) {
        console.log("Category Id : "+category.id);
        var deferred = $q.defer();
        $scope.selectCategory(category.id).then( function (index) {
            if(!$scope.productCategories[index].products) {
                products.getByCategory(category.id).then(function (result) {
                    if (result.errorCode == 'OK') {
                        deferred.resolve(result.tools);
                    }
                });
            }
        });
        return deferred.promise;
    };

    $scope.selectCategory = function (id) {
        var deferred = $q.defer();
        $scope.getCategories().then( function (result) {
            var i = 0;
            $scope.productCategories.forEach(function (item) {
                if (item.id == id) {
                    $scope.currentCategory = i;
                    deferred.resolve(i);
                }
                i++;
            });
        });
        return deferred.promise;
    };

    $scope.selectProduct = function (productId) {
        var deferred = $q.defer();
        productCategories.getAll().then(function (result) {
            if (result.errorCode == 'OK') {
                $scope.productCategories = result.toolCategories;
                deferred.resolve($scope.productCategories);
                $scope.productCategories.forEach(function (item) {
                    var categoryId = item.id;
                    products.getByCategory(categoryId).then(function (result) {
                        if (result.errorCode == 'OK') {
                            item.products = result.tools;
                            var i = 0;
                            $scope.productCategories.forEach(function (item) {
                                if(item.products && item.products.length > 0) {
                                    var j = 0;
                                    item.products.forEach(function (product) {
                                        if (product.id == productId) {
                                            $scope.currentCategory = i;
                                            $scope.currentProduct = j;
                                            products.get(productId).then(function (result) {
                                                console.log(result);
                                                $scope.selectedProduct = result.data.tool[0];
                                            });
                                        }
                                        j++;
                                    });
                                    i++;
                                }
                            });
                        }
                    });
                });
            }
        });
        return deferred.promise;
    };

}]);