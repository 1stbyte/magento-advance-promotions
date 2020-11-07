<?php


namespace The1stByte\AdvancePromotions\Plugin;


use Magento\SalesRule\Model\Rule;
use Magento\SalesRule\Model\Rule\Metadata\ValueProvider;

class RuleValueProviderObserver
{

    /**
     * @param ValueProvider $subject
     * @param $result
     * @param Rule $rule
     * @return mixed
     */
    public function afterGetMetadataValues(ValueProvider $subject, $result, Rule $rule)
    {
        $result['actions']['children']['tfb[promo_sku]'] = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'value' => "Test",
                    ],
                ]
            ]
        ];
        return $result;
    }
}
