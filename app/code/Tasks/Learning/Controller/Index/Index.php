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

namespace Tasks\Learning\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->_resultPageFactory = $pageFactory;
        $this->logger = $logger;
        return parent::__construct($context);
    }

    /**
     * @return void
     */
    public function execute()
    {
        $moduleName = $this->getRequest()->getModuleName();
        $controller = $this->getRequest()->getControllerName();
        $action = $this->getRequest()->getActionName();
        $message = $moduleName . ' ' . $controller . ' ' . $action . ' ';

        $this->logger->addDebug("LOG DEBUG: $message"); // log location: var/log/system.log
        $this->logger->addInfo("LOG INFO: $message"); // log location: var/log/exception.log
        $this->logger->addNotice("LOG NOTICE: $message"); // log location: var/log/exception.log
        $this->logger->addError("LOG ERROR: $message"); // log location: var/log/exception.log
        $this->logger->critical(new \Exception("LOG EXCEPTION CRITICAL: $message")); // log location: var/log/exception.log

        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}