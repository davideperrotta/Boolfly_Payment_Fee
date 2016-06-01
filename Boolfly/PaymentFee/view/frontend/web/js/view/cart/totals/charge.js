
/*global define*/
define(
    [
        'Boolfly_PaymentFee/js/view/cart/summary/charge'
    ],
    function (Component) {
        "use strict";
        return Component.extend({
            defaults: {
                template: 'Boolfly_PaymentFee/cart/totals/paymentfee'
            },
            /**
             * @override
             *
             * @returns {boolean}
             */
            isDisplayed: function () {
                return this.getPureValue() != 0;
            }
        });
    }
);
