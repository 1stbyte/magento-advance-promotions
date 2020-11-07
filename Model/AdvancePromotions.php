<?php

namespace The1stByte\AdvancePromotions\Model;

use The1stByte\AdvancePromotions\Model\ResourceModel\AdvancePromotions as AdvancePromotionsResource;

class AdvancePromotions extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'the1stbyte_advancepromotions_advancepromotions';

    protected $_cacheTag = 'the1stbyte_advancepromotions_advancepromotions';

    protected $_eventPrefix = 'the1stbyte_advancepromotions_advancepromotions';

    protected function _construct()
    {
        $this->_init(AdvancePromotionsResource::class);
    }

    public function getRuleId()
    {
        return $this->getData('rule_id');
    }

    public function setRuleId($rule_id)
    {
        return $this->setData('rule_id', $rule_id);
    }

    public function getTfb()
    {
        return $this->getData('tfb') ? json_decode($this->getData('tfb'), true) : [];
    }

    public function setTfb(array $tfb)
    {
        return $this->setData('tfb', json_encode($tfb));
    }

    public function getCreatedAt()
    {
        return $this->getData('created_at');
    }

    public function setUpdatedAt($updated_at)
    {
        return $this->setData('updated_at', $updated_at);
    }

    public function getUpdatedAt()
    {
        return $this->getData('updated_at');
    }

    public function setCreatedAt($created_at)
    {
        return $this->setData('created_at', $created_at);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
