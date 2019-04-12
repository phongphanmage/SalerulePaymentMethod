<?php
namespace Fram\CouponCodePayment\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Stdlib\CookieManagerInterface;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use \Magento\Framework\Exception\LocalizedException;

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
        $response = [];

        $paymentCodeAvailable = $this->rulesFactory->create()
            ->getCollection()
            ->addFieldToFilter('rule_id', ['in' => $applyRuleIds])
            ->getColumnValues('payment_code_available');

        if(isset($paymentCodeAvailable) && isset($paymentCodeAvailable[0]) && $paymentCodeAvailable[0] == 0)
        {
            return [];
        }

        if(!empty($paymentCodeAvailable))
        {
            foreach($paymentCodeAvailable as $paymentCodeString)
            {
                $convertedString = $this->convertStringToArray($paymentCodeString);

                if(is_array($convertedString) && !empty($convertedString))
                {
                    foreach($convertedString as $code)
                    {
                        $response[] = $code;
                    }
                }else{
                    $response[] = $convertedString;
                }
            }
        }

        return array_unique($response);
    }


    public function convertStringToArray($string)
    {
        return explode(',', $string);
    }
}