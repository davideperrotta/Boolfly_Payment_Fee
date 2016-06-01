<?php

namespace Boolfly\PaymentFee\Block\Sales;

class Totals extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \Magento\Sales\Model\Order
     */
    protected $_order;

    /**
     * @var \Magento\Framework\DataObject
     */
    protected $_source;

    /**
     * @var \Boolfly\PaymentFee\Helper\Data
     */
    protected $_helperData;

    /**
     * OrderFee constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Boolfly\PaymentFee\Helper\Data $helperData
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Boolfly\PaymentFee\Helper\Data $helperData,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_helperData = $helperData;
    }

    /**
     * Check if we nedd display full tax total info
     *
     * @return bool
     */
    public function displayFullSummary()
    {
        return true;
    }

    /**
     * Get data (totals) source model
     *
     * @return \Magento\Framework\DataObject
     */
    public function getSource()
    {
        return $this->_source;
    }
    public function getStore()
    {
        return $this->_order->getStore();
    }

    /**
     * @return \Magento\Sales\Model\Order
     */
    public function getOrder()
    {
        return $this->_order;
    }

    /**
     * @return array
     */
    public function getLabelProperties()
    {
        return $this->getParentBlock()->getLabelProperties();
    }

    /**
     * @return array
     */
    public function getValueProperties()
    {
        return $this->getParentBlock()->getValueProperties();
    }

    /**
     * Initialize payment fee totals
     *
     * @return $this
     */
    public function initTotals()
    {
        $parent = $this->getParentBlock();
        $this->_order = $parent->getOrder();
        $this->_source = $parent->getSource();
        if(!$this->_source->getPaymentCharge()) {
            return $this;
        }
        $fee = new \Magento\Framework\DataObject(
            [
                'code' => 'payment_charge',
                'strong' => false,
                'value' => $this->_source->getPaymentCharge(),
                'label' => __('Surcharge Fee'),
            ]
        );

        $parent->addTotal($fee, 'fee');
        return $this;
    }
}


