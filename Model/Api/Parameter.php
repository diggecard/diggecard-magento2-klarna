<?php
/**
 * This file is part of the Klarna Base module
 *
 * (c) Klarna Bank AB (publ)
 *
 * For the full copyright and license information, please view the NOTICE
 * and LICENSE files that were distributed with this source code.
 */

namespace Diggecard\KlarnaIntegration\Model\Api;

use Klarna\Base\Helper\ConfigHelper;
use Klarna\Base\Model\Api\OrderLineProcessor;
use Klarna\Base\Model\Checkout\Orderline\Collector;
use Magento\Framework\DataObjectFactory;
use Magento\Framework\Url;
use Magento\Framework\Stdlib\DateTime;
use Magento\Framework\DataObject;
use Klarna\Base\Model\Api\Parameter as KlarnaParametr;


/**
 * Class Parameter
 * @package Diggecard\KlarnaIntegration\Model\Api
 */
class Parameter extends KlarnaParametr
{
    /**
     * @var float $diggecardGiftCardUnitPrice
     */
    private $diggecardGiftCardUnitPrice;
    /**
     * @var float $diggecardGiftCardTaxRate
     */
    private $diggecardGiftCardTaxRate;
    /**
     * @var float $diggecardGiftCardTotalAmount
     */
    private $diggecardGiftCardTotalAmount;
    /**
     * @var float $diggecardGiftCardTaxAmount
     */
    private $diggecardGiftCardTaxAmount;
    /**
     * @var string $diggecardGiftCardTitle
     */
    private $diggecardGiftCardTitle;
    /**
     * @var string $diggecardGiftCardReference
     */
    private $diggecardGiftCardReference;


    public function __construct(
        Collector $collector,
        Url $url,
        ConfigHelper $configHelper,
        DateTime\DateTime $coreDate,
        DataObject\Copy $objCopyService,
        \Magento\Customer\Model\AddressRegistry $addressRegistry,
        DataObjectFactory $dataObjectFactory,
        OrderLineProcessor $orderLineProcessor
    )
    {
        parent::__construct($collector, $url, $configHelper, $coreDate, $objCopyService, $addressRegistry, $dataObjectFactory, $orderLineProcessor);
    }

    /**
     * Getting back the gift card account unit price
     *
     * @return float
     */
    public function getDiggecardGiftCardUnitPrice()
    {
        return $this->diggecardGiftCardUnitPrice;
    }

    /**
     * Setting the gift card account unit price
     *
     * @param float $diggecardGiftCardUnitPrice
     * @return $this
     */
    public function setDiggecardGiftCardUnitPrice($diggecardGiftCardUnitPrice)
    {
        $this->diggecardGiftCardUnitPrice = $diggecardGiftCardUnitPrice;
        return $this;
    }

    /**
     * Getting back the gift card account tax rate
     *
     * @return float
     */
    public function getDiggecardGiftCardTaxRate()
    {
        return $this->diggecardGiftCardTaxRate;
    }

    /**
     * Setting the gift card account tax rate
     *
     * @param float $diggecardGiftCardTaxRate
     * @return $this
     */
    public function setDiggecardGiftCardTaxRate($diggecardGiftCardTaxRate)
    {
        $this->diggecardGiftCardTaxRate = $diggecardGiftCardTaxRate;
        return $this;
    }

    /**
     * Getting back the gift card account total amount
     *
     * @return float
     */
    public function getDiggecardGiftCardTotalAmount()
    {
        return $this->diggecardGiftCardTotalAmount;
    }

    /**
     * Setting the gift card account total amount
     *
     * @param float $diggecardGiftCardTotalAmount
     * @return $this
     */
    public function setDiggecardGiftCardTotalAmount($diggecardGiftCardTotalAmount)
    {
        $this->diggecardGiftCardTotalAmount = $diggecardGiftCardTotalAmount;
        return $this;
    }

    /**
     * Getting back the gift card account tax amount
     *
     * @return float
     */
    public function getDiggecardGiftCardTaxAmount()
    {
        return $this->diggecardGiftCardTaxAmount;
    }

    /**
     * Setting the gift card account tax amount
     *
     * @param float $diggecardGiftCardTaxAmount
     * @return $this
     */
    public function setDiggecardGiftCardTaxAmount($diggecardGiftCardTaxAmount)
    {
        $this->diggecardGiftCardTaxAmount = $diggecardGiftCardTaxAmount;
        return $this;
    }

    /**
     * Getting back the gift card account title
     *
     * @return string
     */
    public function getDiggecardGiftCardTitle()
    {
        return $this->diggecardGiftCardTitle;
    }

    /**
     * Setting the gift card account title
     *
     * @param string $diggecardGiftCardTitle
     * @return $this
     */
    public function setDiggecardGiftCardTitle($diggecardGiftCardTitle)
    {
        $this->diggecardGiftCardTitle = $diggecardGiftCardTitle;
        return $this;
    }

    /**
     * Getting back the gift card account reference
     *
     * @return string
     */
    public function getDiggecardGiftCardReference()
    {
        return $this->diggecardGiftCardReference;
    }

    /**
     * Setting the gift card account reference
     *
     * @param string $diggecardGiftCardReference
     * @return $this
     */
    public function setDiggecardGiftCardReference($diggecardGiftCardReference)
    {
        $this->diggecardGiftCardReference = $diggecardGiftCardReference;
        return $this;
    }
}
