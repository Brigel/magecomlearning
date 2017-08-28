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

namespace Tasks\Learning\Controller\Adminhtml;

/**
 * Class MagecomItem
 * @package Tasks\Learning\Controller\Adminhtml
 */
abstract class MagecomItem extends \Magento\Backend\App\Action
{
    /**
     * MagecomItem Factory
     *
     * @var \Tasks\Learning\Model\MagecomItemFactory
     */
    protected $_magecomItemFactory;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * Result redirect factory
     *
     * @var \Magento\Backend\Model\View\Result\RedirectFactory
     */
    protected $_resultRedirectFactory;

    /**
     * constructor
     *
     * @param \Tasks\Learning\Model\MagecomItemFactory $magecomItemFactory
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Tasks\Learning\Model\MagecomItemFactory $magecomItemFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Backend\App\Action\Context $context
    ) {
        $this->_magecomItemFactory = $magecomItemFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->_resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    /**
     * Init Item
     *
     * @return \Tasks\Learning\Model\MagecomItem
     */
    protected function _initMagecomItem()
    {
        $magecomItemId = (int)$this->getRequest()->getParam('id');
        /** @var \Tasks\Learning\Model\MagecomItem $magecomItem */
        $magecomItem = $this->_magecomItemFactory->create();
        if ($magecomItemId) {
            $magecomItem->load($magecomItemId);
        }
        $this->_coreRegistry->register('tasks_learning_magecomitem', $magecomItem);
        return $magecomItem;
    }
}
