# diggecard-magento2-klarna

## Prerequisites for Installation
* Install latest version of [Klarna Checkout (8.0) module](https://marketplace.magento.com/klarna-m2-checkout.html) for Magento 2
* Install [Diggecard gift card module](https://github.com/seniordevonly/diggecard-magento2) for Magento 2

## Installation procedure
1. Update your composer.json file<br>
`$ composer require digg-ecard/diggecard-klarna-integration`
1. Enable the extension<br>
`$ php bin/magento module:enable Diggecard_KlarnaIntegration`
1. Register the extension<br>
`$ php bin/magento setup:upgrade`
1. Recompile your Magento project<br>
`$ php bin/magento setup:di:compile`
1. Clean the cache<br>
`$ php bin/magento cache:flush`
