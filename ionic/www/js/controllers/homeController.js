(function () {
    angular.module('starter.controllers')
        .controller('HomeController', ['$http', '$cookies', '$ionicPopup', '$state',
            function ($http, $cookies, $ionicPopup, $state) {

                var self = this;

                self.getUser = function () {
                    $http({
                        method: 'GET',
                        url: 'http://localhost:8000/api/authenticated',
                        headers: {
                            'Authorization': 'Bearer '.concat(cookie.access_token)
                        }
                    }).then(function (response) {
                        self.username = response.data.data.name;
                    }, function (response) {
                        $ionicPopup.alert({
                            title: 'Advertência',
                            template: 'Usuário ou senha incorreto(s)'
                        });
                        $state.go('login');
                    });
                };

                var cookie = $cookies.getObject('token');
                if (cookie != undefined) {
                    self.getUser();
                } else {
                    $state.go('login');
                }

            }]
        )
})();