(function () {
    angular.module('starter.services')
        .factory('Order', ['appConfig', '$resource',
            function (appConfig, $resource) {

                return $resource(appConfig.baseUrl + '/api/client/order/:id', {id: '@id'}, {
                    query: {
                        isArray: false
                    }
                });

            }])
})();