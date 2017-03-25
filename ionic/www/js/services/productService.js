(function () {
    angular.module('starter.services')
        .factory('Product', ['appConfig', '$resource',
            function (appConfig, $resource) {

                return $resource(appConfig.baseUrl + '/api/client/products', {}, {
                    query: {
                        isArray: false
                    }
                });

            }])
})();