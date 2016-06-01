<?php

namespace Boolfly\PaymentFee\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    /**
     * Recipient fixed amount of custom payment config path
     */
    const CONFIG_NEW_ORDER_STATES = 'payment/paymentfee/fixedamount';

    /**
     * Get fixed amount of custom payment
     *
     * @return mixed
     */
    public function getFixedAmount()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $fixedAmount = $this->scopeConfig->getValue(self::CONFIG_NEW_ORDER_STATES, $storeScope);

        return $fixedAmount;
    }

}