<?php

namespace Tasks\Brand\Model\ResourceModel\Brand;

use Magento\Eav\Model\Entity\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Tasks\Brand\Model\Brand', 'Tasks\Brand\Model\ResourceModel\Brand');
    }
}
