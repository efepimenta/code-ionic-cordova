(function () {
    angular.module('starter.controllers')
        .controller('LoginController', ['OAuth', '$ionicPopup', '$state',
            function (OAuth, $ionicPopup, $state) {

                var self = this;
                self.user = {};

                self.login = function () {
                    OAuth.getAccessToken(self.user)
                        .then(function (data) {
                            $state.go('home');
                        }, function (error) {
                            $ionicPopup.alert({
                                title: 'Advertência',
                                template: 'Usuário ou senha incorreto(s)'
                            });
                        });
                };
            }]
        )
})();