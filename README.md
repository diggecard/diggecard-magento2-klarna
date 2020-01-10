# diggecard-magento2-klarna

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
