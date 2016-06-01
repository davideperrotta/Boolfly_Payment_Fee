/*browser:true*/
/*global define*/
define(
    [
        'ko',
        'jquery',
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        ko,
        $,
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'paymentfee',
                component: 'Boolfly_PaymentFee/js/view/payment/method-renderer/paymentfee'
            }
        );


        /** Add view logic here if needed */
        return Component.extend({});
    }
);