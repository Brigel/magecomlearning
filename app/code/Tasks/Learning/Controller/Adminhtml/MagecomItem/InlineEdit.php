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

namespace Tasks\Learning\Controller\Adminhtml\MagecomItem;

/**
 * Class InlineEdit
 * @package Tasks\Learning\Controller\Adminhtml\MagecomItem
 */
abstract class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * JSON Factory
     *
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $_jsonFactory;

    /**
     * MagecomItem Factory
     *
     * @var \Tasks\Learning\Model\MagecomItemFactory
     */
    protected $_magecomItemFactory;

    /**
     * constructor
     *
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Tasks\Learning\Model\MagecomItemFactory $magecomItemFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Tasks\Learning\Model\MagecomItemFactory $magecomItemFactory,
        \Magento\Backend\App\Action\Context $context
    ) {
        $this->_jsonFactory = $jsonFactory;
        $this->_magecomItemFactory = $magecomItemFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->_jsonFactory->create();
        $error = false;
        $messages = [];
        $magecomItemItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($magecomItemItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }
        foreach (array_keys($magecomItemItems) as $magecomItemId) {
            /** @var \Tasks\Learning\Model\MagecomItem $magecomItem */
            $magecomItem = $this->_magecomItemFactory->create()->load($magecomItemId);
            try {
                $magecomItemData = $magecomItemItems[$magecomItemId];//todo: handle dates
                $magecomItem->addData($magecomItemData);
                $magecomItem->save();
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithmagecomItemId($magecomItem, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithmagecomItemId($magecomItem, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithmagecomItemId(
                    $magecomItem,
                    __('Something went wrong while saving the Item.')
                );
                $error = true;
            }
        }
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add Item id to error message
     *
     * @param \Tasks\Learning\Model\MagecomItem $magecomItem
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithmagecomItemId(\Tasks\Learning\Model\MagecomItem $magecomItem, $errorText)
    {
        return '[Item ID: ' . $magecomItem->getId() . '] ' . $errorText;
    }
}
