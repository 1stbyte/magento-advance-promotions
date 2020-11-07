<?php

namespace The1stByte\AdvancePromotions\Model\Rule\Action\Discount;

use DateInterval;
use Magento\Customer\Model\Session;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Quote\Model\Quote\Item\AbstractItem;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactoryInterface;
use Magento\SalesRule\Model\Rule;
use Magento\SalesRule\Model\Rule\Action\Discount\AbstractDiscount;
use Magento\SalesRule\Model\Rule\Action\Discount\Data;
use Magento\SalesRule\Model\Rule\Action\Discount\DataFactory;
use Magento\SalesRule\Model\Validator;

class CustomP extends AbstractDiscount
{
    /**
     * @var Session
     */
    private $customerSession;
    /**
     * @var CollectionFactoryInterface
     */
    private $orderCollectionFactory;
    /**
     * @var TimezoneInterface
     */
    private $localeDate;

    /**
     * CustomP constructor.
     * @param TimezoneInterface $localeDate
     * @param CollectionFactoryInterface $orderCollectionFactory
     * @param Session $customerSession
     * @param Validator $validator
     * @param DataFactory $discountDataFactory
     * @param PriceCurrencyInterface $priceCurrency
     */
    public function __construct(
        TimezoneInterface $localeDate,
        CollectionFactoryInterface $orderCollectionFactory,
        Session $customerSession,
        Validator $validator,
        DataFactory $discountDataFactory,
        PriceCurrencyInterface $priceCurrency
    )
    {
        parent::__construct($validator, $discountDataFactory, $priceCurrency);
        $this->customerSession = $customerSession;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->localeDate = $localeDate;
    }

    /**
     * @param Rule $rule
     * @param AbstractItem $item
     * @param float $qty
     * @return Data
     */
    public function calculate($rule, $item, $qty)
    {
        $discountData = $this->discountFactory->create();

        if (!$this->customerSession->isLoggedIn()) {
            return $discountData;
        }

        $step_amount = 55;
        $discount_amount = 10;
        $duration = 7;

        $customer = $this->customerSession->getCustomer();
        $order_from = $this->localeDate->date()->sub(new DateInterval("P{$duration}D"));

        $orders = $this->orderCollectionFactory
            ->create($customer->getId())
            ->addFieldToSelect('*')
            ->addFieldToFilter('created_at', ['gt' => $order_from])
            ->setOrder('created_at', 'desc')->getItems();

        $total_paid = 0;

        foreach ($orders as $order) {
            $total_paid += $order->getGrandTotal();
        }

        if (!$total_paid || $step_amount > $total_paid) {
            return $discountData;
        }

        $steps = floor($total_paid / $step_amount) * $discount_amount;

        $discountData->setAmount($steps);
        $discountData->setBaseAmount($steps);
        $discountData->setOriginalAmount($steps);
        $discountData->setBaseOriginalAmount($steps);

        return $discountData;
    }
}
