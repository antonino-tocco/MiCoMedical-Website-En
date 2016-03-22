var App = angular.module('ClinicoApp',['ngSanitize', 'BEServiceModule'])
    .controller('BootController',['$scope','$rootScope','$http', '$sce','$q', '$window','productCategories','products',
        function ($scope, $rootScope, $http, $sce, $q, $window, productCategories, products) {
            var tool;

            var category;

            var getCategoryTitle = function () {
                return category.name;
            };
            var getCategoryTitleByTool = function () {
                return tool.toolCategory.name;
            };
            var getCategoryIdByTool = function ()  {
                return tool.toolCategory.id;
            };
            var getToolTitle = function () {
                return tool.name;
            };
            /*
            var getPageProperties = function () {
                var location = window.location.pathname;
                var search = window.location.search;
                var id = search.split("=")[1];
                var propertiesList = {
                    "": {
                        title: 'home',
                        breadcrumb: '<a href="http://46.252.150.202/" rel="v:url" property="v:title">Home</a>'
                    },
                    "/": {
                        title: 'home',
                        breadcrumb: '<a href="http://46.252.150.202/" rel="v:url" property="v:title">Home</a>'
                    },
                    "/chi-siamo/": {
                        title: 'chi siamo',
                        breadcrumb: '<a href="http://46.252.150.202/" rel="v:url" property="v:title">Home</a> >> <span class="current">Chi siamo</span>'
                    },
                    "/ultime-notizie/": {
                        title: 'ultime notizie',
                        breadcrumb: '<a href="http://46.252.150.202/" rel="v:url" property="v:title">Home</a> >> <span class="current">Ultime notizie</span>'
                    },
                    "/prodotti/": {
                        title: 'prodotti',
                        breadcrumb: '<a href="http://46.252.150.202/" rel="v:url" property="v:title">Home</a> >> <span class="current">Prodotti</span>'
                    },
                    "/assistenza/": {
                        title: 'assistenza',
                        breadcrumb: '<a href="http://46.252.150.202/" rel="v:url" property="v:title">Home</a> >> <span class="current">Assistenza</span>'
                    },
                    "/carriere/": {
                        title: 'carriere',
                        breadcrumb: '<a href="http://46.252.150.202/" rel="v:url" property="v:title">Home</a> >> <span class="current">Carriere</span>'
                    },
                    "/lavora-con-noi/": {
                        title: 'lavora con noi',
                        breadcrumb: '<a href="http://46.252.150.202/" rel="v:url" property="v:title">Home</a> >> <span class="current">Lavora con noi</span>'
                    },
                    "/contattaci/": {
                        title: 'contattaci',
                        breadcrumb: '<a href="http://46.252.150.202/" rel="v:url" property="v:title">Home</a> >> <span class="current">Contattaci</span>'
                    },
                    "/registrati/": {
                        title: 'registrati',
                        breadcrumb: '<a href="http://46.252.150.202/" rel="v:url" property="v:title">Home</a> >> <span class="current">Registrati</span>'
                    },
                    "/prodotti/categoria-prodotti/": {
                        title: location === '/prodotti/categoria-prodotti/' ? getCategoryTitle() : '',
                        breadcrumb: location === '/prodotti/categoria-prodotti/' ? '<a href="http://46.252.150.202/" rel="v:url" property="v:title">Home</a> >> <span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="http://46.252.150.202/prodotti/">Prodotti</a></span> >> <span class="current">' + getCategoryTitle() + '</span>' : ''
                    },
                    "/prodotti/categoria-prodotti/prodotto/": {
                        title: location === '/prodotti/categoria-prodotti/prodotto/' ? getToolTitle(): '',
                        breadcrumb: location === '/prodotti/categoria-prodotti/prodotto/' ? '<a href="http://46.252.150.202/" rel="v:url" property="v:title">Home</a> >> <span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="http://46.252.150.202/prodotti/">Prodotti</a></span> >> <span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="http://46.252.150.202/prodotti/categoria-prodotti/?id='+ getCategoryIdByTool() +'">' + getCategoryTitleByTool() +'</a></span> >> <span class="current">' + getToolTitle() + '</span>' : ''
                    }
                };
                return propertiesList[location];
            };*/
            var getBlockPopupValue = (function () {
                $http({method:'GET',url:'/wp-content/themes/clinico/async/get_block_popup.php'})
                    .then(function (result) {
                        var data = result.data;
                        if(data.errorCode === 'OK') {
                            $scope.blocked = data.blocked;
                        }
                    });
                }());
            /*
            var setPageProperties = (function () {
                var location = window.location.pathname;
                var search = window.location.search;
                switch (location) {
                    case "/prodotti/categoria-prodotti/":
                        var id = search.split("=")[1];
                        productCategories.get(id).then(function (result) {
                            category = result.data.toolCategory[0];
                            var properties = getPageProperties();
                            $scope.pageTitle = properties.title;
                            $scope.breadcrumbs = $sce.trustAsHtml(properties.breadcrumb);
                        });
                    break;
                    case "/prodotti/categoria-prodotti/prodotto/":
                        var id = search.split("=")[1];
                        products.get(id).then(function (result) {
                            tool = result.data.tool[0];
                            var properties = getPageProperties();
                            $scope.pageTitle = properties.title;
                            $scope.breadcrumbs = $sce.trustAsHtml(properties.breadcrumb);
                        });
                        break;
                    default:
                        var properties = getPageProperties();
                        $scope.pageTitle = properties.title;
                        $scope.breadcrumbs = $sce.trustAsHtml(properties.breadcrumb);
                }
            }());*/

            //region Popup method

            $scope.unBlockPopup = function () {
                $scope.blocked = false;
                $http({method:'GET',url:'/wp-content/themes/clinico/async/unblockpopup.php'})
                    .then( function (result) {
                        console.log(result);
                    });
            };

            $scope.blockPopupMessage = 'Relativamente ai prodotti venduti da Mi.Co.Medical S.r.l. ed aventi la seguente natura: dispositivi medici e dispositivi medico – diagnostici in vitro, presidi medico chirurgici si significa che: tutti i contenuti del sito micomedical.it ' +
                'relativi a tali prodotti (testi, immagini, foto, disegni, allegati e quant’altro) non hanno carattere né natura di pubblicità.'+
                'Tutti i contenuti devono intendersi e sono di natura esclusivamente informativa e volti esclusivamente a portare a conoscenza dei clienti e dei potenziali clienti in fase di preacquisto i prodotti venduti da Mi.Co.Medical S.r.l. attraverso la rete.';

            $scope.popupStyle = '';
            //endregion

            //region Language

            $scope.languages = [
                    { id : 0, label: 'IT' },
                    { id : 1, label: 'EN' }
                ];

            var setCurrentLanguage = (function () {
                $scope.selectedLanguage = $scope.languages[0];
            }());

            $scope.getMenuItemLabel = (function (title) {
                return title;
            });

            /*
            $scope.changeSelectedLanguage = (function (index) {
                $scope.selectedLanguage = $scope.languages[index];
                var location = window.location.pathname;
                var search = window.location.search;
                //NEW PATH VARIABLE FOR REDIRECT
                var newLocation;
                if(index === 1) {
                    console.log("LOCATION -> " + location);
                    console.log("SEARCH -> " + search);
                    switch(location) {
                        //FIRST LEVEL NAVIGATION
                        case '':
                        case '/':
                            newLocation = '/en/';
                            break;
                        case '/chi-siamo/':
                            newLocation = '/en/about-us/';
                            break;
                        case '/ultime-notizie/':
                            newLocation = '/en/news/';
                            break;
                        case '/prodotti/':
                            newLocation = '/en/products/';
                            break;
                        case '/assistenza/':
                            newLocation = '/en/assistance/';
                            break;
                        case '/carriere/':
                            newLocation = '/en/careers/';
                            break;
                        case '/lavora-con-noi/':
                            newLocation = '/en/work-with-us/';
                            break;
                        case '/contattaci/':
                            newLocation = '/en/contact/';
                            break;
                        case '/registrati/':
                            newLocation = '/en/register/';
                            break;
                        case '/prodotti/categoria-prodotti/':
                            newLocation = '/en/products/category-products/' + search;
                            break;
                        case '/prodotti/categoria-prodotti/prodotto/':
                            newLocation = '/en/products/category-products/product/' + search;
                            break;
                    }
                    window.location.href = newLocation;
                }
            });
            */

            $scope.$watch("blocked", function () {
                $scope.popupStyle = $scope.blocked == true ? 'display:block': ''
            });

            console.log("Loaded boot controller");
        //endregion

    }]);