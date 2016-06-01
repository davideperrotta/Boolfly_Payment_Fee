<?php

namespace Boolfly\PaymentFee\Model;

class PaymentFeeConfigProvider implements \Magento\Checkout\Model\ConfigProviderInterface
{
    /**
     * @var string[]
     */
    protected $methodCode = \Boolfly\PaymentFee\Model\PaymentFee::PAYMENT_METHOD_FEE_CODE;

    /**
     * @var \Boolfly\PaymentFee\Model\PaymentFee
     */
    protected $method;

    /**
     * PaymentFeeConfigProvider constructor.
     * @param \Magento\Payment\Helper\Data $paymentHelper
     */
    public function __construct(
        \Magento\Payment\Helper\Data $paymentHelper
    ) {
        $this->method = $paymentHelper->getMethodInstance($this->methodCode);
    }
    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        return $this->method->isAvailable() ? [
            'payment' => [
                'paymentfee' => [
                    'fixedamount' => $this->getFixedAmount(),
                ],
            ],
        ] : [];
    }
    protected function getFixedAmount()
    {
        return $this->method->getFixedAmount();
    }
}