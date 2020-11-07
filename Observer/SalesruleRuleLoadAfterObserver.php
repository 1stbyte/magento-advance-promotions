<?php

namespace The1stByte\AdvancePromotions\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\SalesRule\Model\Rule;
use The1stByte\AdvancePromotions\Model\AdvancePromotions as AdvancePromotionsAlias;
use The1stByte\AdvancePromotions\Model\AdvancePromotionsFactory;

class SalesruleRuleLoadAfterObserver implements ObserverInterface
{
    /**
     * @var AdvancePromotionsFactory
     */
    private $advancePromotionsFactory;

    /**
     * SalesruleRuleLoadAfterObserver constructor.
     * @param AdvancePromotionsFactory $advancePromotionsFactory
     */
    public function __construct(
        AdvancePromotionsFactory $advancePromotionsFactory
    )
    {
        $this->advancePromotionsFactory = $advancePromotionsFactory;
    }

    public function execute(Observer $observer)
    {
        /** @var Rule $rule */
        $rule = $observer->getEvent()->getData('rule');

        /** @var AdvancePromotionsAlias $model */
        $model = $this->advancePromotionsFactory->create();
        $model->load($rule->getEntityId(), 'rule_id');

        $rule->setData('tfb', $model->getTfb());
    }
}
