<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Newsletter\Helper;

class DataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\TestFramework\ObjectManager
     */
    protected $_objectManager;

    /**
     * @var \Magento\Newsletter\Model\Subscriber
     */
    protected $_subscriber;

    protected function setUp()
    {
        $this->_objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
        $this->_subscriber = $this->_objectManager->get('Magento\Newsletter\Model\Subscriber');
    }

    /**
     * @magentoAppIsolation enabled
     */
    public function testGetConfirmationUrl()
    {
        $url = $this->_objectManager->get('Magento\Newsletter\Helper\Data')->getConfirmationUrl($this->_subscriber);
        $this->assertTrue(strpos($url, 'newsletter/subscriber/confirm') > 0);
        $this->assertFalse(strpos($url, 'admin'));
    }

    /**
     * @magentoAppIsolation enabled
     */
    public function testGetUnsubscribeUrl()
    {
        $url = $this->_objectManager->get('Magento\Newsletter\Helper\Data')->getUnsubscribeUrl($this->_subscriber);
        $this->assertTrue(strpos($url, 'newsletter/subscriber/unsubscribe') > 0);
        $this->assertFalse(strpos($url, 'admin'));
    }

}
