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

namespace Tasks\Learning\Block\Adminhtml\MagecomItem;

/**
 * Class Edit
 * @package Tasks\Learning\Block\Adminhtml\MagecomItem
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * constructor
     *
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize Item edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'Tasks_Learning';
        $this->_controller = 'adminhtml_magecomItem';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Item'));
        $this->buttonList->add(
            'save-and-continue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ],
            -100
        );
        $this->buttonList->update('delete', 'label', __('Delete Item'));
    }

    /**
     * Retrieve text for header element depending on loaded Item
     *
     * @return string
     */
    public function getHeaderText()
    {
        /** @var \Tasks\Learning\Model\MagecomItem $item */
        $item = $this->_coreRegistry->registry('tasks_learning_magecomitem');
        if ($item->getId()) {
            return __("Edit Item '%1'", $this->escapeHtml($item->getName()));
        }
        return __('New Item');
    }
}
