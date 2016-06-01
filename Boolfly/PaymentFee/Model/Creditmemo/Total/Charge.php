<?php

namespace Boolfly\PaymentFee\Model\Creditmemo\Total;

use Magento\Sales\Model\Order\Creditmemo\Total\AbstractTotal;

class Charge extends AbstractTotal
{
    /**
     * @param \Magento\Sales\Model\Order\Creditmemo $creditmemo
     * @return $this
     */
    public function collect(\Magento\Sales\Model\Order\Creditmemo $creditmemo)
    {
        $creditmemo->setPaymentCharge(0);
        $creditmemo->setBasePaymentCharge(0);

        $amount = $creditmemo->getOrder()->getPaymentCharge();
        $creditmemo->setPaymentCharge($amount);

        $amount = $creditmemo->getOrder()->getBasePaymentCharge();
        $creditmemo->setBasePaymentCharge($amount);

        $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $creditmemo->getPaymentCharge());
        $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $creditmemo->getBasePaymentCharge());

        return $this;
    }
}