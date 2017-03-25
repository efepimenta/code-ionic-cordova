(function () {
    angular.module('starter.controllers')
        .controller('ClientViewProductsController',
            ['Product', '$state', '$ionicLoading', '$cart',
                function (Product, $state, $ionicLoading, $cart) {

                    var self = this;
                    self.products = [];

                    $ionicLoading.show({
                        template: 'Carregando...'
                    });

                    Product.query({}, function (data) {
                        self.products = data.data;
                        $ionicLoading.hide();
                    }, function (error) {
                        $ionicLoading.hide();
                    });

                    self.addItem = function (item) {
                        item.qtd = 1;
                        $cart.addItem(item);
                        $state.go('client.checkout')
                    };

                }]
        )
})();