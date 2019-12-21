<?php
/**
 * @author DiggEcard Team
 * @copyright Copyright (c) 2019 DiggEcard (https://diggecard.com)
 */

namespace Diggecard\KlarnaIntegration\Model\Checkout\Orderline\Items;

use Klarna\Base\Model\Api\Parameter;
use Klarna\Base\Model\Checkout\Orderline\DataHolder;
use Magento\Quote\Api\Data\CartInterface;
use Klarna\Base\Api\OrderLineInterface;
use Klarna\Base\Helper\DataConverter;
use Magento\Sales\Api\Data\OrderInterface;

/**
 * Generate order line details for gift card
 */
class Diggecard implements OrderLineInterface
{
    /**
     * Code from QuoteDiscount
     */
    const SEGMENT_CODE = 'diggecard_giftcard_discount';

    /**
     * Checkout item type
     */
    const GIFT_CARD_ACCOUNT = 'giftcardaccount';

    /** @var DataConverter $helper */
    private $helper;

    /**
     * Order line code name
     *
     * @var string
     */
    private $code;

    /**
     * @param DataConverter $helper
     * @codeCoverageIgnore
     */
    public function __construct(DataConverter $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Retrieve code name
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set code name
     *
     * @param string $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function collectPrePurchase(Parameter $parameter, DataHolder $dataHolder, CartInterface $quote)
    {
        return $this->collect($parameter, $dataHolder);
    }

    /**
     * {@inheritdoc}
     */
    public function collectPostPurchase(Parameter $parameter, DataHolder $dataHolder, OrderInterface $order)
    {
        return $this->collect($parameter, $dataHolder);
    }

    /**
     * Collecting the values
     *
     * @param Parameter $parameter
     * @param DataHolder $dataHolder
     * @return $this
     */
    private function collect(Parameter $parameter, DataHolder $dataHolder)
    {
        $totals = $dataHolder->getTotals();
        if (!is_array($totals) || !isset($totals[self::SEGMENT_CODE])) {
            return $this;
        }
        $total = $totals[self::SEGMENT_CODE];
        $value = $total->getValue();

        $value = $this->helper->toApiFloat($value);
        $giftCardTitle = $total->getTitle();

        // Sum gift cards, if 'Magento_GiftCardAccount' used
        if (isset($totals[self::GIFT_CARD_ACCOUNT])) {
            $giftCardTotal = $totals[self::GIFT_CARD_ACCOUNT];
            $giftCardValue = $giftCardTotal->getValue();
            $giftCardValue = $this->helper->toApiFloat($giftCardValue);

            $value = $giftCardValue + $value;
            $giftCardTitle = __('Gift Cards');
        }

        $parameter->setGiftCardAccountUnitPrice($value)
            ->setGiftCardAccountTaxRate(0)
            ->setGiftCardAccountTotalAmount($value)
            ->setGiftCardAccountTaxAmount(0)
            ->setGiftCardAccountTitle($giftCardTitle)
            ->setGiftCardAccountReference($total->getCode());

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function fetch(Parameter $checkout)
    {
        return $this;
    }
}
