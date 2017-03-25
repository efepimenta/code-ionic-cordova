(function () {
    angular.module('starter.controllers')
        .controller('ClientCheckoutSuccess', ['$state', '$cart',
            function ($state, $cart) {

                var self = this;
                self.items = $cart.get().items;
                self.total = $cart.get().total;
                $cart.clear();

                self.openListOrder = function () {
                    $state.go('client.view_orders');
                };
            }]
        )
})();