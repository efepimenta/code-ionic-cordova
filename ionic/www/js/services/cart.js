(function () {
    angular.module('starter.controllers')
        .service('$cart', ['$localStorage', function ($localStorage) {

                var self = this;
                var key = 'cart';
                var cartStart = $localStorage.getObject(key);
                if (!cartStart) {
                    self.clear();
                }

                self.clear = function () {
                    init();
                };

                self.get = function () {
                    return $localStorage.getObject(key);
                };

                self.getItem = function (index) {
                    return self.get().items[index];
                };

                self.addItem = function (item) {
                    var cart = $localStorage.getObject(key), itemAux, exists = false;
                    for (var index in cart.items) {
                        itemAux = cart.items[index];
                        if (itemAux.id === item.id) {
                            itemAux.qtd += item.qtd;
                            itemAux.subtotal = calculateSubTotal(itemAux);
                            exists = true;
                            break;
                        }
                    }
                    if (!exists) {
                        item.subtotal = calculateSubTotal(item);
                        cart.items.push(item);
                    }
                    cart.total = getTotal(cart.items);
                    $localStorage.setObject(key, cart);
                };

                self.removeItem = function (index) {
                    var cart = $localStorage.getObject(key);
                    cart.items.splice(index, 1);
                    cart.total = getTotal(cart.items);
                    $localStorage.setObject(key, cart);
                };

                self.updateQtd = function (index, qtd) {
                    var cart = self.get(),
                        itemAux = cart.items[index];
                    itemAux.qtd = qtd;
                    itemAux.subtotal = calculateSubTotal(itemAux);
                    cart.total = getTotal(cart.items);
                    $localStorage.setObject(key, cart);
                };

                var calculateSubTotal = function (item) {
                    return item.price * item.qtd;
                };

                var getTotal = function (items) {
                    var sum = 0;
                    angular.forEach(items, function (item) {
                        sum += item.subtotal;
                    });
                    return sum;
                };

                var init = function () {
                    $localStorage.setObject(key, {
                        items: [],
                        total: 0
                    });
                };

                return self;

            }]
        );
})();