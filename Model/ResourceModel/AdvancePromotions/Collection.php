<?php

namespace The1stByte\AdvancePromotions\Model\ResourceModel\AdvancePromotions;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use The1stByte\AdvancePromotions\Model\AdvancePromotions as AdvancePromotionsModel;
use The1stByte\AdvancePromotions\Model\ResourceModel\AdvancePromotions as AdvancePromotionsResource;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'the1stbyte_advancepromotions_advancepromotions_collection';
    protected $_eventObject = 'advancepromotions_collection';

    protected function _construct()
    {
        $this->_init(AdvancePromotionsModel::class, AdvancePromotionsResource::class);
    }
}
