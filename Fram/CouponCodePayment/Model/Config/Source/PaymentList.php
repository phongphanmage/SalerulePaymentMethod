<?php

namespace Fram\CouponCodePayment\Model\Config\Source;

class PaymentList implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Payment data
     *
     * @var \Magento\Payment\Model\Config
     */
    protected $paymentConfig;

    /**
     * @param \Magento\Payment\Model\Config $paymentConfig
     */
    public function __construct(
        \Magento\Payment\Model\Config $paymentConfig
    )
    {
        $this->paymentConfig = $paymentConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        $paymentsList =  $this->paymentConfig->getActiveMethods();

        $response = [];

        foreach($paymentsList as $paymentCode => $paymentData)
        {
            $response[] = [
                'value' => $paymentCode,
                'label' => $paymentData->getTitle().' ('.$paymentCode.' )'

            ];
        }
        return $response;

    }
}