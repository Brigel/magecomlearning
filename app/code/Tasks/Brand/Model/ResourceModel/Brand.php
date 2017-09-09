<?php

namespace Tasks\Brand\Model\ResourceModel;

use Magento\Eav\Model\Entity\AbstractEntity;

class Brand extends AbstractEntity
{
    protected  function _construct()
    {
        $this->_read = 'tasks_brand_read';
        $this->_write = 'tasks_brand_write';
    }

    public function getEntityType()
    {
        if (empty($this->_type)) {
            $this->setType(\Tasks\Brand\Model\Brand::ENTITY);
        }

        return parent::getEntityType();
    }
}