(function () {
    angular.module('starter.controllers')
        .controller('ClientCheckoutController', ['$state', '$cart', '$ionicLoading', 'Order', '$ionicPopup',
            function ($state, $cart, $ionicLoading, Order, $ionicPopup) {

                var self = this;

                self.items = $cart.get().items;
                self.total = $cart.get().total;

                self.removeItem = function (index) {
                    $cart.removeItem(index);
                    self.items = $cart.get().items;
                    self.total = $cart.get().total;
                };

                self.openProductDetail = function (index) {
                    $state.go('client.checkout_item_detail', {index: index});
                };

                self.openListProducts = function () {
                    $state.go('client.view_products');
                };

                self.save = function () {
                    $ionicLoading.show({
                        template: 'Carregando...'
                    });
                    var items = angular.copy(self.items);
                    angular.forEach(items, function (item) {
                        item.product_id = item.id;
                    });
                    Order.save({id: null}, {items: items}, function (data) {
                        $ionicLoading.hide();
                        $state.go('client.checkout_success');
                    }, function (error) {
                        $ionicLoading.hide();
                        $ionicPopup.alert({
                            title: 'Erro',
                            template: 'Pedido não realizado'
                        });
                    });
                };

            }]
        )
})();