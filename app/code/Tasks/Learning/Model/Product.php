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

namespace Tasks\Learning\Model;

/**
 * Class Product override Magento\Catalog\Model\Product
 * @package Tasks\Learning\Model
 */
class Product extends \Magento\Catalog\Model\Product
{
    /**
     * Override method getStatus() for all Products
     * @return int
     */
    public function getStatus()
    {
        return \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED;
    }
}