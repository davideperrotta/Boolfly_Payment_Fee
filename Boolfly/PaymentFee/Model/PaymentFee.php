<?php

namespace Boolfly\PaymentFee\Model;

class PaymentFee extends \Magento\Payment\Model\Method\AbstractMethod
{
    const PAYMENT_METHOD_FEE_CODE = 'paymentfee';

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::PAYMENT_METHOD_FEE_CODE;
    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;

    public function getFixedAmount()
    {
        //Data from system.xml fields
        return $this->getConfigData('fixedamount');
    }
}