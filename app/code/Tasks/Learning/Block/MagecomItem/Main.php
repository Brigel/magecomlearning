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

namespace Tasks\Learning\Block\MagecomItem;

use Tasks\Learning\Model\MagecomItemFactory;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Main
 * @package Tasks\Learning\Block\MagecomItem
 */
class Main extends \Magento\Framework\View\Element\Template
{
    /**
     * @var MagecomItemFactory
     */
    protected $itemsFactory;

    /**
     * @param Context $context
     * @param MagecomItemFactory $itemsFactory
     */
    public function __construct(
        Context $context,
        MagecomItemFactory $itemsFactory
    ) {
        parent::__construct($context);
        $this->itemsFactory = $itemsFactory;
    }

    /**
     * @return array
     */
    public function getAllItems()
    {
        $itemsModel = $this->itemsFactory->create();

        $itemsCollection = $itemsModel->getCollection();
        return $itemsCollection->getData();
    }

}