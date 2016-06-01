<?php

namespace Boolfly\PaymentFee\Model\Invoice\Total;

use Magento\Sales\Model\Order\Invoice\Total\AbstractTotal;

class Charge extends AbstractTotal
{
    /**
     * @param \Magento\Sales\Model\Order\Invoice $invoice
     * @return $this
     */
    public function collect(\Magento\Sales\Model\Order\Invoice $invoice)
    {
        $invoice->setPaymentCharge(0);
        $invoice->setBasePaymentCharge(0);

        $amount = $invoice->getOrder()->getPaymentCharge();
        $invoice->setPaymentCharge($amount);
        $amount = $invoice->getOrder()->getBasePaymentCharge();
        $invoice->setBasePaymentCharge($amount);

        $invoice->setGrandTotal($invoice->getGrandTotal() + $invoice->getPaymentCharge());
        $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $invoice->getBasePaymentCharge());

        return $this;
    }
}