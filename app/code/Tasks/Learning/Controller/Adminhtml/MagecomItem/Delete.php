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
 * Class Delete
 * @package Tasks\Learning\Controller\Adminhtml\MagecomItem
 */
class Delete extends \Tasks\Learning\Controller\Adminhtml\MagecomItem
{
    /**
     * execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->_resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $name = "";
            try {
                /** @var \Tasks\Learning\Model\MagecomItem $magecomItem */
                $magecomItem = $this->_magecomItemFactory->create();
                $magecomItem->load($id);
                $name = $magecomItem->getName();
                $magecomItem->delete();
                $this->messageManager->addSuccess(__('The Item has been deleted.'));
                $this->_eventManager->dispatch(
                    'adminhtml_tasks_learning_magecomitem_on_delete',
                    ['name' => $name, 'status' => 'success']
                );
                $resultRedirect->setPath('learn/*/');
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_tasks_learning_magecomitem_on_delete',
                    ['name' => $name, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                $resultRedirect->setPath('learn/*/edit', ['id' => $id]);
                return $resultRedirect;
            }
        }
        // display error message
        $this->messageManager->addError(__('Item to delete was not found.'));
        // go to grid
        $resultRedirect->setPath('learn/*/');
        return $resultRedirect;
    }
}
