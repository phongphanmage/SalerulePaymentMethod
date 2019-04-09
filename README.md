# Salerule - Payment Method | Magento 2

=================================

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.me/phongphanmage)

# Description:
- When user's cart or coupon code was matched/used, this module will only allow payment method which belong to the rules in admin setting.

# Installation:
1. Copy module folder to your `magento_root_folder/app/code`.
2. Go to your `magento_root_folder`. Run these commands:
    - `php ./bin/magento   setup:upgrade`
    - `php ./bin/magento   setup:di:compile`
    - `php ./bin/magento   setup:static-content:deploy`
    
    
# Configuration:
1. Go to `Marketing` -> `Cart Price Rules`
2. Choose your payment available for the rules.


#Example:
- Your website has 3 payment methods: COD, Paypal, Braintree.
- You settings up 2 rules whose available for Paypal and another one for Braintree.
- If customer's cart passed those rules, customer can only place order with Paypal and Braintree - COD will be disable.
 

# Magento version compatible:
- Magento version  2.2.x., Magento version  2.3.x.

# Report issues:
- For any issue please help me open an issue.
    
 
   
    
