<?php
namespace Fram\CouponCodePayment\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\DataObject;

class GetAllAvailablePaymentForAppliedRules extends \Magento\Framework\App\Helper\AbstractHelper
{

    private $rulesFactory;

    public function __construct(
        Context $context,
        \Magento\SalesRule\Model\RuleFactory $rulesFactory
    )
    {
        parent::__construct($context);
        $this->rulesFactory             = $rulesFactory;
    }

    public function execute($applyRuleIds)
    {
        $response = [
            'all_payments_available' => true,
            'codes'                  => []
        ];

        $paymentCodeAvailable = $this->rulesFactory->create()
            ->getCollection()
            ->addFieldToFilter('rule_id', ['in' => $applyRuleIds])
            ->getColumnValues('payment_code_available');

        if(isset($paymentCodeAvailable[0]) && ($paymentCodeAvailable[0] !== "") && !empty($paymentCodeAvailable))
        {
            $response ['all_payments_available'] = false;

            foreach($paymentCodeAvailable as $paymentCodeString)
            {

                $convertedString = $this->convertStringToArray($paymentCodeString);

                if(is_array($convertedString) && !empty($convertedString))
                {
                    foreach($convertedString as $code)
                    {
                        $response['codes'][] = $code;
                    }
                }else{
                    $response['codes'][] = $convertedString;
                }
            }
            $response['codes'] = array_unique($response['codes']);

            return new DataObject($response);
        }else
        {
            return new DataObject($response);
        }
    }


    public function convertStringToArray($string)
    {
        return explode(',', $string);
    }
}