<?php

namespace Tasks\Brand\Setup;

use Tasks\Brand\Model\BrandFactory;
use Magento\Eav\Model\Entity\Setup\Context;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class BrandSetup extends EavSetup
{
    /**
     * Category model factory
     *
     * @var BrandFactory
     */
    private $brandFactory;

    /**
     * Init
     *
     * @param ModuleDataSetupInterface $setup
     * @param Context $context
     * @param CacheInterface $cache
     * @param CollectionFactory $attrGroupCollectionFactory
     * @param BrandFactory $brandFactory
     */
    public function __construct(
        ModuleDataSetupInterface $setup,
        Context $context,
        CacheInterface $cache,
        CollectionFactory $attrGroupCollectionFactory,
        BrandFactory $brandFactory
    ) {
        $this->brandFactory = $brandFactory;
        parent::__construct($setup, $context, $cache, $attrGroupCollectionFactory);
    }

    /**
     * Creates brand model
     *
     * @param array $data
     * @return \Tasks\Brand\Model\Brand
     * @codeCoverageIgnore
     */
    public function createCategory($data = [])
    {
        return $this->brandFactory->create($data);
    }

    /**
     * Default entities and attributes
     *
     * @return array
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function getDefaultEntities()
    {
        return [
            'tasks_brand' => [
                'entity_model' => 'Tasks\Brand\Model\ResourceModel\Brand',
                'attribute_model' => 'Magento\Catalog\Model\ResourceModel\Eav\Attribute',
                'table' => 'brand_entity',
                'entity_attribute_collection' => 'Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection',
                'attributes' => [
                    'name' => [
                        'type' => 'varchar',
                        'label' => 'Name',
                        'input' => 'text',
                        'source' => 'Tasks\Brand\Model\Product\Attribute\Source\Brand',
                        'frontend_class' => 'validate-length maximum-length-255',
                        'sort_order' => 1,
                        'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    ],
                    'description' => [
                        'type' => 'text',
                        'label' => 'Description',
                        'input' => 'textarea',
                        'required' => false,
                        'sort_order' => 2,
                        'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                        'wysiwyg_enabled' => true,
                        'is_html_allowed_on_front' => true,
                    ],
                    'status' => [
                        'type' => 'int',
                        'label' => 'Status',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 10,
                        'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    ],
                ],
            ]
        ];
    }
}
