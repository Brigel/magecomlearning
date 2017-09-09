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

namespace Tasks\Learning\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Class TopMenuObserver
 * @package Tasks\Learning\Observer
 */
class TopMenuObserverBeforeCollection implements ObserverInterface
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * Catalog category
     *
     * @var \Magento\Catalog\Helper\Category
     */
    protected $catalogCategory;
    /**
     * @var \Magento\Catalog\Model\Indexer\Category\Flat\State
     */
    protected $categoryFlatState;
    /**
     * @var MenuCategoryData
     */
    protected $menuCategoryData;

    /**
     * @param \Magento\Catalog\Helper\Category $catalogCategory
     * @param \Magento\Catalog\Model\Indexer\Category\Flat\State $categoryFlatState
     * @param \Magento\Catalog\Observer\MenuCategoryData $menuCategoryData
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Catalog\Helper\Category $catalogCategory,
        \Magento\Catalog\Model\Indexer\Category\Flat\State $categoryFlatState,
        \Magento\Catalog\Observer\MenuCategoryData $menuCategoryData
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->catalogCategory = $catalogCategory;
        $this->categoryFlatState = $categoryFlatState;
        $this->menuCategoryData = $menuCategoryData;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $collectionObj = $observer->getCategoryCollection();
        $object = $collectionObj->getNewEmptyItem()->setData([
                "entity_id" => "9999",
                "parent_id" => "2",
                "request_path" => "learn/index/index",
                "name" => "SUPER MENU"
        ]);
        $collectionObj->addItem($object);
//        if (isset($collectionObj->_itemsById[$object->getId()])) {
//            $collectionObj->_itemsById[$object->getId()][] = $object;
//        } else {
//            $collectionObj->_itemsById[$object->getId()] = [$object];
//        }
    }

}
