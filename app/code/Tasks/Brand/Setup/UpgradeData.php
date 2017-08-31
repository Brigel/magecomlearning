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
    protected $employeeFactory;

    public function __construct(
        \Tasks\Brand\Model\BrandFactory $brandFactory
    ) {
        $this->employeeFactory = $brandFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $setup->startSetup();

        $employee = $this->employeeFactory->create();
        $employee->setName('qweqweew');
        $employee->setStatus(2);
        $employee->setDescriprion('ppppppppppppppppppppppppppppp');
        $employee->save();

        $setup->endSetup();
    }
}