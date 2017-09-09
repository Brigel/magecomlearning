<?php
/**
 * Created by IntelliJ IDEA.
 * User: user
 * Date: 31.08.17
 * Time: 13:35
 */
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

namespace Tasks\Brand\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class UpgradeData
 * @package Tasks\TestEav\Setup
 */
class UpgradeData implements UpgradeDataInterface {

    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var \Tasks\Brand\Model\BrandFactory
     */
    protected $brandFactory;

    /**
     * Brand setup factory
     *
     * @var BrandSetupFactory
     */
    private $brandSetupFactory;

    /**
     * UpgradeData constructor.
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     * @param \Tasks\Brand\Model\BrandFactory $brandFactory
     * @param BrandSetupFactory $brandSetupFactory
     */
    public function __construct(
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory,
        \Tasks\Brand\Model\BrandFactory $brandFactory,
        BrandSetupFactory $brandSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->brandFactory = $brandFactory;
        $this->brandSetupFactory = $brandSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $setup->startSetup();
        $brandEntity = \Tasks\Brand\Model\Brand::ENTITY;

        $brandSetup = $this->brandSetupFactory->create(['setup' => $setup]);

        $brand = $this->brandFactory->create();

        $brand->setName('yuyuuiyuiiy');
        $brand->setStatus(2);
        $brand->setDescription('nbnvnvbnvbnvbnvbnbvnvbnvnb');
        $brand->save();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'brand',
            [
                'type' => 'int',
                'label' => 'Brand',
                'input' => 'select',
                'source' => 'Tasks\Brand\Model\Config\BrandSource',
                'default' => 0,
            ]
        );


        $setup->endSetup();
    }
}