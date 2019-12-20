<?php
/**
 * This file is part of the Klarna Base module
 *
 * (c) Klarna Bank AB (publ)
 *
 * For the full copyright and license information, please view the NOTICE
 * and LICENSE files that were distributed with this source code.
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
    const ITEM_TYPE_GIFTCARD = 'gift_card';

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
        /** @var \Diggecard\KlarnaIntegration\Model\Api\Parameter $parameter */
        $parameter->setDiggecardGiftCardUnitPrice($value)
            ->setDiggecardGiftCardTaxRate(0)
            ->setDiggecardGiftCardTotalAmount($value)
            ->setDiggecardGiftCardTaxAmount(0)
            ->setDiggecardGiftCardTitle($total->getTitle())
            ->setDiggecardGiftCardReference($total->getCode());

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function fetch(Parameter $checkout)
    {
        /** @var \Diggecard\KlarnaIntegration\Model\Api\Parameter $checkout */
        if ($checkout->getGiftcardaccountTotalAmount()) {
            $checkout->addOrderLine([
                'type'             => self::ITEM_TYPE_GIFTCARD,
                'reference'        => $checkout->getDiggecardGiftCardReference(),
                'name'             => $checkout->getDiggecardGiftCardTitle(),
                'quantity'         => 1,
                'unit_price'       => $checkout->getDiggecardGiftCardUnitPrice(),
                'tax_rate'         => $checkout->getDiggecardGiftCardTaxRate(),
                'total_amount'     => $checkout->getDiggecardGiftCardTotalAmount(),
                'total_tax_amount' => $checkout->getDiggecardGiftCardTaxAmount(),
            ]);
        }

        return $this;
    }
}
