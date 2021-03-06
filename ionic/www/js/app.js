// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter', ['ionic', 'starter.controllers', 'angular-oauth2','starter.services'])
    .constant('appConfig',{
        baseUrl: 'http://localhost:8000'
    })
    .run(function ($ionicPlatform) {
        $ionicPlatform.ready(function () {
            if (window.cordova && window.cordova.plugins.Keyboard) {
                // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
                // for form inputs)
                cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

                // Don't remove this line unless you know what you are doing. It stops the viewport
                // from snapping when text inputs are focused. Ionic handles this internally for
                // a much nicer keyboard experience.
                cordova.plugins.Keyboard.disableScroll(true);
            }
            if (window.StatusBar) {
                StatusBar.styleDefault();
            }
        });
    })
    .config(['$stateProvider', '$urlRouterProvider',
        function ($stateProvider, $urlRouterProvider) {
            $urlRouterProvider.otherwise('home');
            $stateProvider
                .state('login', {
                    url: '/login',
                    templateUrl: 'templates/login.html',
                    controller: 'LoginController as vm'
                })
                .state('home', {
                    url: '/home',
                    templateUrl: 'templates/home.html',
                    controller: 'HomeController as vm'
                })
                .state('client', {
                    abstract: true,
                    url: '/client',
                    template: '<ion-nav-view/>'
                })
                .state('client.checkout', {
                    url: '/checkout',
                    cache: false,
                    templateUrl: 'templates/client/checkout.html',
                    controller: 'ClientCheckoutController as vm'
                })
                .state('client.checkout_item_detail', {
                    url: '/checkout/detail/:index',
                    templateUrl: 'templates/client/checkout-item-detail.html',
                    controller: 'ClientCheckoutDetailController as vm'
                })
                .state('client.checkout_success',{
                    ul: '/checkout/checkout_success',
                    templateUrl: 'templates/client/checkout-success.html',
                    controller: 'ClientCheckoutSuccess as vm'
                })
                .state('client.view_products', {
                    url: '/view_products',
                    templateUrl: 'templates/client/view-products.html',
                    controller: 'ClientViewProductsController as vm'
                })
                .state('client.view_orders', {
                    url: '/view_orders',
                    cache: false,
                    templateUrl: 'templates/client/view-orders.html',
                    controller: 'ClientViewOrdersController as vm'
                })
        }])
    .config(['OAuthProvider', 'OAuthTokenProvider','appConfig', function (OAuthProvider, OAuthTokenProvider, appConfig) {
        OAuthProvider.configure({
            baseUrl: appConfig.baseUrl,
            clientId: 'appid01',
            clientSecret: 'secret',
            grantPath: '/oauth/access_token'
        });
        OAuthTokenProvider.configure({
            name: 'token',
            options: {
                secure: false
            }
        });
    }]);

angular.module('starter.controllers', []);
angular.module('starter.services', ['ngResource']);