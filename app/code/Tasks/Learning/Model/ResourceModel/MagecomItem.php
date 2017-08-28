<?php
/**
 * Magecom
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@magecom.net so we can send you a copy immediately.
 *
 * @category Magecom
 * @package Magecom_Module
 * @copyright Copyright (c) 2017 Magecom, Inc. (http://www.magecom.net)
 * @license  http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Tasks\Learning\Model\ResourceModel;

/**
 * Class MagecomItem
 * @package Tasks\Learning\Model\ResourceModel
 */
class MagecomItem extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('magecom_learning_items', 'id');
    }

    /**
     * Retrieves Item Name from DB by passed id.
     *
     * @param string $id
     * @return string|bool
     */
    public function getItemNameById($id)
    {
        $adapter = $this->getConnection();
        $select = $adapter->select()
            ->from($this->getMainTable(), 'name')
            ->where('id = :id');
        $binds = ['id' => (int)$id];
        return $adapter->fetchOne($select, $binds);
    }
//    /**
//     * before save callback
//     *
//     * @param \Magento\Framework\Model\AbstractModel|\Tasks\Learning\Model\MagecomItem $object
//     * @return $this
//     */
//    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
//    {
//        $object->setUpdatedAt($this->_date->date());
//        if ($object->isObjectNew()) {
//            $object->setCreatedAt($this->_date->date());
//        }
//        return parent::_beforeSave($object);
//    }
}
