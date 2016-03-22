/**
 * Created by entony on 18/11/15.
 */
var BEService = angular.module('BEServiceModule', [])
    .factory('constants', [function () {
       return {
            "CATEGORY": "CATEGORY_",
            "TOOL": "TOOL_",
            "REGION": "REGION_",
            "PROVINCE": "PROVINCE_",
            "TOWN": "TOWN_",
            "NEWS_CAT": '73',
            "EVENTS_CAT": '74'
       }
    }])
    .service('storage', [ function () {
        hashCode = function (s) {
            return (s + "").split("").reduce(function (a, b) {
                a = ((a << 5) - a) + b.charCodeAt(0);
                return a & a
            }, 0);
        };
        var memorycache = {};
        return {
            get: function (key) {
                var value = memorycache[hashCode(key)];
                return value ? JSON.parse(value) : undefined;
            },
            set: function (key, value) {
                memorycache[hashCode(key)] = JSON.stringify(value);
            },
            delete: function (key) {
                console.debug("Remove object with key : " + key);
                delete memorycache[hashCode(key)];
            }
        }
    }])
    .service('queryEngine', ['$http', 'constants',function ($http, constants) {

        var baseUrl = 'http://www.micomedical.it/area_riservata/web/';
        var jsonAPIBaseUrl = 'http://www.micomedical.it/en/';
        var analyticsService = baseUrl + 'api/v1/analytics/';
        var apiService = baseUrl + 'api/v1/';
        var userService = baseUrl + 'customer/';
        var registerService = baseUrl + 'app_dev.php/site/register';
       var getPost = jsonAPIBaseUrl + '?json=get_posts';

        //GET METHOD
        var get = function (url, success, error) {
            // qui ci va il caching layer
            $http({ method:'GET', url: url}).then(success, error);
        };

        var post = function (url, data , success, error) {
            jQuery.ajax({
                    method:'POST',
                    url: url,
                    data: data,
                    dataType: 'json'
                }).then(success, error);
        };
        return {
            getRegionByDistributorPresence: function (success, error) {
                get(apiService + 'region/get_by_distributor', success, error);
            },
            getAllRegions: function (success, error) {
                get(apiService + 'region/getAll', success, error);
            },
            getProvincesByRegion: function (data, success, error) {
                get(apiService + 'province/getByRegion/' + data.region, success, error);
            },
            getTownsByProvince: function (data, success, error) {
                get(apiService + 'town/getByProvince/' + data.province, success, error);
            },
            getPostCodeByTown: function (data, success, error) {
                get(apiService + 'post_code/getByTown/' + data.town, data, success, error);
            },
            getToolCategory: function (id, success, error) {
                get(apiService + 'tool_category/get/' + id, success, error);
            },
            getAllToolCategories: function (success, error) {
                get(apiService + 'tool_category/getAll', success, error);
            },
            getToolByCategory: function (id, success, error) {
                get(apiService + 'tool/get_by_category/' +id, success, error);
            },
            getTool: function (id, success, error) {
                get(apiService + 'tool/get/' + id, success, error);
            },
            getAllTool: function (success, error) {
                get(apiService + 'tool/getAll', success, error);
            },
            registerUser: function (data, success, error) {
                post(registerService, data, success, error);
            },
            getNews: function (data, success, error) {
                var url = getPost;
                for(var key in data) {
                    if(key !== 'limit') {
                        url += '&' + key + "=" + data[key];
                    }
                }
                get(url, success, error);
            },
            getEvents: function (data, success, error) {
                var url = getPost;
                for(var key in data) {
                    if(key !== 'limit') {
                        url += '&' + key + "=" + data[key]
                    }
                }
                get(url, success, error);
            }
        }
    }])
    .service('location', ['$q', function ($q) {
        var jsonLocation = '/wp-content/themes/clinico/app/json/location.json';

        return {
            getRegion: function () {
                var deferred = $q.defer();
                jQuery.getJSON(jsonLocation, function (data) {
                    deferred.resolve(data);
                });
                return deferred.promise;
            },
            getProvinces: function (region) {
                return region.provincie;
            },
            getTowns: function (province) {
                return province.comuni;
            },
            getCap: function (town) {
                return town.cap;
            }
    }
    }])
    .service('productCategories',['queryEngine','$q','constants','storage',function (queryEngine,$q,constants,storage) {

        var module = {};

        module.getAll = function () {
            var deferred = $q.defer();
            queryEngine.getAllToolCategories(function (result) {
                var data = result.data;
                deferred.resolve(data);
            });
            return deferred.promise;
        };
        module.get = function (id) {
            var deferred = $q.defer();
            var productCategory = storage.get(constants.CATEGORY + id);
            if(productCategory) {
                deferred.resolve(productCategory);
            } else {
                queryEngine.getToolCategory(id, function (result) {
                    var data = result.data;
                    module.data = data;
                    module.save;
                    deferred.resolve(module);
                });
            }
            return deferred.promise;
        };

        module.save = function (id) {
            storage.set(constants.TOOL + id, this);
        };

        return module;
    }])
    .service('products',['queryEngine','$q','constants','storage',function (queryEngine,$q,constants,storage) {

        var module = {};

        module.getAll = function () {
            var deferred = $q.defer();
            queryEngine.getAllTool(function (result) {
                var data = result.data;
                deferred.resolve(data);
            });
            return deferred.promise;
        };
        module.get = function (id) {
            var deferred = $q.defer();
            var product = storage.get(constants.TOOL + id);
            if(product) {
                deferred.resolve(product);
            } else {
                queryEngine.getTool(id, function (result) {
                    var data = result.data;
                    module.data = data;
                    module.save();
                    deferred.resolve(module);
                });
            }
            return deferred.promise;
        };

        module.getByCategory = function (id) {
            var deferred = $q.defer();
            queryEngine.getToolByCategory(id, function (result) {
                var data = result.data;
                deferred.resolve(data);
            });
            return deferred.promise;
        };

        module.save = function (id) {
            storage.set(constants.TOOL + id, this);
        };
        return module;
    }])
    .service('regions',['queryEngine','$q', function (queryEngine,$q){

        var module = {};

        module.getAll = function () {
            var deferred = $q.defer();
            queryEngine.getAllRegions(function (result) {
                var data = result.data;
                deferred.resolve(data);
            });
            return deferred.promise;
        };

        module.getByDistributorPresence = function () {
            var deferred = $q.defer();
            queryEngine.getRegionByDistributorPresence(function (result) {
                var data = result.data;
                deferred.resolve(data);
            });
            return deferred.promise;
        };

        return module;
    }])
    .service('provinces', ['queryEngine','$q', function (queryEngine,$q) {
        var module = {};

        module.getByRegion = function (data) {
            var deferred = $q.defer();
            queryEngine.getProvincesByRegion(data, function (result) {
                var data = result.data;
                deferred.resolve(data);
            });
            return deferred.promise;
        };

        return module;
    }])
    .service('towns', ['queryEngine','$q', function (queryEngine,$q) {
        var module = {};

        module.getByProvince = function (data) {
            var deferred = $q.defer();
            queryEngine.getTownsByProvince(data, function (result) {
                var data = result.data;
                deferred.resolve(data);
            });
            return deferred.promise;
        };
        return module;
    }])
    .service('postCode', ['queryEngine','$q', function (queryEngine,$q) {
        var module = {};

        module.getByTown = function (data) {
            var deferred = $q.defer();
            queryEngine.getPostCodeByTown(data, function (result) {
                var data = result.data;
                deferred.resolve(data);
            });
            return deferred.promise;
        };

        return module;

    }])
    .service('user', ['queryEngine', '$q', function (queryEngine, $q) {
        var module = {};

        module.registerUser = function (data) {
            var deferred = $q.defer();
            queryEngine.registerUser(data, function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        };

        return module;
    }])
    .service('news', ['queryEngine', '$q', 'constants', function (queryEngine, $q, constants) {
        var module = {};

        module.getNews = function (limit) {
            var deferred = $q.defer();
            var data = {
                cat: constants.NEWS_CAT,
                orderby: 'date',
                order: 'DESC'
            };
            queryEngine.getNews(data, function (result) {
               var data = result.data;
                deferred.resolve(data);
            });
            return deferred.promise;
        };

        return module;
    }])
    .service('events', ['queryEngine', '$q', 'constants', function (queryEngine, $q, constants) {
        var module = {};

        module.getEvents = function (limit) {
            var deferred = $q.defer();
            var data = {
                cat: constants.EVENTS_CAT,
                orderby: 'date',
                order: 'DESC'
            };
            queryEngine.getEvents(data, function (result) {
                var data = result.data;
                deferred.resolve(data);
            });
            return deferred.promise;
        };
        return module;
    }]);