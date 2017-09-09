<?php

namespace Tasks\Brand\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * Brand setup factory
     *
     * @var BrandSetupFactory
     */
    private $brandSetupFactory;

    /**
     * @var \Tasks\Brand\Model\BrandFactory
     */
    protected $brandFactory;

    /**
     * UpgradeData constructor.
     * @param \Tasks\Brand\Model\BrandFactory $brandFactory
     */
    public function __construct(
        \Tasks\Brand\Model\BrandFactory $brandFactory,
        BrandSetupFactory $brandSetupFactory
    )
    {
        $this->brandFactory = $brandFactory;
        $this->brandSetupFactory = $brandSetupFactory;
    }



    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        /**
         * Install additional eav fields before add data
         */
        $this->installEntities($setup);

        /** @var \Tasks\Brand\Model\Brand $brand */
        $brand = $this->brandFactory->create();

        $data = $this->getDefaultData();

        foreach ($data as $item) {
            foreach ($item as $fieldName => $value) {
                $brand->setData($fieldName, $value);
            }
            $brand->save();
            $brand->unsetData();
        }

        $setup->endSetup();
    }

    /**
     * @return array
     */
    private function getDefaultData()
    {
        $defaultPicture = 'http://icons.iconarchive.com/icons/paomedia/small-n-flat/256/file-picture-icon.png';
        $data = [
            [
                'name' => 'Guchini',
                'status' => \Tasks\Brand\Model\Config\Status::STATUS_ENABLED,
                'description' => 'Super guchini brand!',
                'url_pic' => $defaultPicture
            ],
            [
                'name' => 'Armanini',
                'status' => \Tasks\Brand\Model\Config\Status::STATUS_ENABLED,
                'description' => 'Super armanini brand!',
                'url_pic' => $defaultPicture
            ],
        ];
        return $data;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     */
    private function installEntities(&$setup)
    {
        /** @var \Tasks\Brand\Setup\BrandSetup $brandSetup */
        $brandSetup = $this->brandSetupFactory->create(['setup' => $setup]);
        $brandSetup->installEntities();
    }

}
