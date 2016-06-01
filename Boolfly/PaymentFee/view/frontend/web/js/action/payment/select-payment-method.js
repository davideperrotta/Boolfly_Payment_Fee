/*global define*/
define(
    [
        'jquery',
        'ko',
        'Magento_Checkout/js/model/quote',
        'Boolfly_PaymentFee/js/action/checkout/cart/totals'
    ],
    function($, ko ,quote, totals) {
        'use strict';
        var isLoading = ko.observable(false);

        return function (paymentMethod) {

            if(paymentMethod.method == 'paymentfee')
            {
                quote.paymentMethod(paymentMethod);
                totals(isLoading, 'paymentfee');

            } else {
                quote.paymentMethod(paymentMethod);
                totals(isLoading, 'others');
            }

        }
    }
);