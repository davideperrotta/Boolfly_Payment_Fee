/*browser:true*/
/*global define*/
define(
    [
        'Magento_Checkout/js/view/payment/default'
    ],
    function (Component) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Boolfly_PaymentFee/payment/paymentfee'
            },

            /** Returns fixed amount */
            getFixedAmount: function() {
                //console.log('--fixedamount--');
                return window.checkoutConfig.payment.paymentfee.fixedamount;
                //return '10';
            }

        });
    }
);