<?php

namespace Boolfly\PaymentFee\Model\Quote\Total;

class Charge extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
    /**
     * @var \Boolfly\PaymentFee\Helper\Data
     */
    protected $_helperData;


    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $_checkoutSession;

    protected $_payment;
    /**
     * Collect grand total address amount
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return $this
     */
    protected $_quoteValidator = null;

    public function __construct(
        \Magento\Quote\Model\QuoteValidator $quoteValidator,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Quote\Api\Data\PaymentInterface $payment,
        \Boolfly\PaymentFee\Helper\Data $helperData
    )
    {
        $this->setCode('paymentfee');
        $this->_quoteValidator = $quoteValidator;
        $this->_helperData = $helperData;
        $this->_checkoutSession = $checkoutSession;
        $this->_payment = $payment;
    }

    /**
     * Collect totals process.
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return $this
     */
    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);

        if (!count($shippingAssignment->getItems())) {
            return $this;
        }

        $fee = 0;
        $paymentMethod = $quote->getPayment()->getMethod();

        if($paymentMethod == 'paymentfee') {
            $fee =  $this->_helperData->getFixedAmount();
        }

        $total->setPaymentCharge($fee);
        $total->setBasePaymentCharge($fee);

        $quote->setPaymentCharge($fee);
        $quote->setBasePaymentCharge($fee);

        $total->setTotalAmount('payment_charge', $fee);
        $total->setBaseTotalAmount('base_payment_charge', $fee);
        $total->setGrandTotal($total->getGrandTotal() + $fee);
        $total->setBaseGrandTotal($total->getBaseGrandTotal() + $fee);

        return $this;
    }

    /**
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     */
    protected function clearValues(\Magento\Quote\Model\Quote\Address\Total $total)
    {
        $total->setTotalAmount('subtotal', 0);
        $total->setBaseTotalAmount('subtotal', 0);
        $total->setTotalAmount('tax', 0);
        $total->setBaseTotalAmount('tax', 0);
        $total->setTotalAmount('discount_tax_compensation', 0);
        $total->setBaseTotalAmount('discount_tax_compensation', 0);
        $total->setTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setSubtotalInclTax(0);
        $total->setBaseSubtotalInclTax(0);
    }

    /**
     * Assign subtotal amount and label to address object
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function fetch(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Model\Quote\Address\Total $total
    )
    {
        $quoteFee = $quote->getPaymentCharge();
        $result = [
                'code' => 'payment_charge',
                'title' => __('Surcharge Fee'),
                'value' => $quoteFee ? $this->_helperData->getFixedAmount() : 0
            ];
        return $result;
    }

    /**
     * Get Subtotal label
     *
     * @return \Magento\Framework\Phrase
     */
    public function getLabel()
    {
        return __('Surcharge Fee');
    }
}