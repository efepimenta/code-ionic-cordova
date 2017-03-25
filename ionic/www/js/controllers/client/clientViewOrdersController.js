(function () {
    angular.module('starter.controllers')
        .controller('ClientViewOrdersController',
            ['Order', '$state', '$ionicLoading', '$filter',
                function (Order, $state, $ionicLoading, $filter) {

                    var self = this;
                    self.orders = [];

                    $ionicLoading.show({
                        template: 'Carregando...'
                    });

                    Order.query({}, function (data) {
                        self.orders = data.data;
                        angular.forEach(self.orders, function (order) {
                            order.created_at.date = $filter('date')(Date.parse(order.created_at.date), 'dd/MM/yyyy hh:mm:ss');
                            switch (order.status){
                                case 0:
                                    order.status = 'Aberto';
                                    break;
                                case 1:
                                    order.status = 'Encaminhado';
                                    break;
                                case 2:
                                    order.status = 'Entregue';
                                    break;
                                default:
                                    order.status = 'Desconhecido';
                            }
                        });
                        $ionicLoading.hide();
                    }, function (error) {
                        $ionicLoading.hide();
                    });

                }]
        )
})();