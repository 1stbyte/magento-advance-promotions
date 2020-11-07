<?php

namespace The1stByte\AdvancePromotions\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class AdvancePromotions extends AbstractDb
{
    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('the1stbyte_advance_promotions_rules', 'entity_id');
    }
}
