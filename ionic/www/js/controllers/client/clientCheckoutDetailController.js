(function () {
    angular.module('starter.controllers')
        .controller('ClientCheckoutDetailController', ['$cart', '$stateParams', '$state',
            function ($cart, $stateParams, $state) {

                var self = this;
                self.product = $cart.getItem($stateParams.index);
                self.new_qtd = self.product.qtd;

                self.updateQtd = function () {
                    $cart.updateQtd($stateParams.index, self.new_qtd);
                    $state.go('client.checkout');
                };


            }]
        )
})();