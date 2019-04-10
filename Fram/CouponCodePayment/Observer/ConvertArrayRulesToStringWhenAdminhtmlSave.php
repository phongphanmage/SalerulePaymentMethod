<?php

namespace Fram\CouponCodePayment\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ConvertArrayRulesToStringWhenAdminhtmlSave implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $request = $observer->getData('request');

        $data = $request->getPostValue();
        if(isset($data['payment_code_available']) && !empty($data['payment_code_available']))
        {
            $request->setPostValue('payment_code_available', $this->_convert($data['payment_code_available']));
        }
        return $request;
    }

    private function _convert($array){
        return implode(',', $array);
    }
}