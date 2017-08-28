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

namespace Tasks\Learning\Block\Config;

use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Main
 * @package Tasks\Learning\Block\Config
 */
class Main extends \Magento\Framework\View\Element\Template
{
    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Main constructor.
     * @param ObjectManagerInterface $objectManager
     * @param Context $context
     */
    public function __construct(ObjectManagerInterface $objectManager, Context $context)
    {
        $this->objectManager = $objectManager;
        parent::__construct($context);
    }

    /**
     * Printing display text config from my configs page
     */
    public function printConfigs()
    {
        $helper = $this->objectManager->create('Tasks\Learning\Helper\Data');
        echo "<pre>";
        print_r($helper->getGeneralConfig("display_text"));
        echo "</pre>";
    }

}