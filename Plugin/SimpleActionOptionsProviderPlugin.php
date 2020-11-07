<?php


namespace The1stByte\AdvancePromotions\Plugin;


use Magento\SalesRule\Model\Rule\Action\SimpleActionOptionsProvider;

class SimpleActionOptionsProviderPlugin
{
    public function afterToOptionArray(SimpleActionOptionsProvider $subject, array $result)
    {
        $result[] = ['label' => __('Get item item free after certain amount of orders'), 'value' => 'custom_p'];
        return $result;
    }
}
