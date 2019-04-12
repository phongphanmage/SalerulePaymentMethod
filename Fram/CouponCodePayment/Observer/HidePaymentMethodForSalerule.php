<?php

namespace Fram\CouponCodePayment\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class HidePaymentMethodForSalerule implements ObserverInterface
{
    private $getAllAvailablePaymentForAppliedRules;

    public function __construct(
        \Fram\CouponCodePayment\Helper\GetAllAvailablePaymentForAppliedRules $getAllAvailablePaymentForAppliedRules
    )
    {
        $this->getAllAvailablePaymentForAppliedRules      = $getAllAvailablePaymentForAppliedRules;
    }

    public function execute(Observer $observer)
    {
        $result = $observer->getEvent()->getResult();

        $methodInstance = $observer->getEvent()->getMethodInstance();

        $quote = $observer->getEvent()->getQuote();

        if(null !== $quote) {

            $applyRuleIds = $this->getAllAvailablePaymentForAppliedRules->convertStringToArray($quote->getAppliedRuleIds());

            $availablePaymentsCode = $this->getAllAvailablePaymentForAppliedRules->execute($applyRuleIds);

            if( isset($availablePaymentsCode[0]) && ($availablePaymentsCode[0] == ""))
            {
                $result->setData('is_available', true);
            }else
            {
                if(!in_array($methodInstance->getCode(), $availablePaymentsCode) && !empty($availablePaymentsCode))
                {
                    $result->setData('is_available', false);
                }
            }
        }


    }

}