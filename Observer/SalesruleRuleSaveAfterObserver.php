<?php

namespace The1stByte\AdvancePromotions\Observer;

use Exception;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\SalesRule\Model\Rule;
use The1stByte\AdvancePromotions\Model\AdvancePromotions;
use The1stByte\AdvancePromotions\Model\AdvancePromotionsFactory;

class SalesruleRuleSaveAfterObserver implements ObserverInterface
{
    /**
     * @var AdvancePromotionsFactory
     */
    private $advancePromotionsFactory;

    /**
     * SalesruleRuleSaveAfterObserver constructor.
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
        $rule = $observer->getEvent()->getData('data_object');

        /** @var AdvancePromotions $model */
        $model = $this->advancePromotionsFactory->create();
        $model->load($rule->getRuleId(), 'rule_id');
        $model->setRuleId($rule->getRuleId());
        $model->setTfb(array_replace_recursive($model->getTfb(), $rule->getData('tfb') ?: []));
        try {
            $model->save();
        } catch (Exception $e) {
            // Todo
        }
    }
}
