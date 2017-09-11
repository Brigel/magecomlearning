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

namespace Tasks\Brand\Block\Brand;

use Magento\Catalog\Api\CategoryRepositoryInterface;

/**
 * Class Grid
 * @package Tasks\Brand\Block\Adminhtml\Brand
 */
class ListProduct extends \Magento\Catalog\Block\Product\ListProduct
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_productCollection;

    /**
     * ListProduct constructor.
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Framework\Data\Helper\PostHelper $postDataHelper
     * @param \Magento\Catalog\Model\Layer\Resolver $layerResolver
     * @param CategoryRepositoryInterface $categoryRepository
     * @param \Magento\Framework\Url\Helper\Data $urlHelper
     * @param \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context, \Magento\Framework\Data\Helper\PostHelper $postDataHelper,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        CategoryRepositoryInterface $categoryRepository,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection,
        array $data = []
    ) {
        $this->_productCollection = $productCollection;
        parent::__construct($context, $postDataHelper, $layerResolver, $categoryRepository, $urlHelper, $data);
    }

    /**
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection|\Magento\Framework\View\Result\PageFactory
     */
    protected function _getProductCollection()
    {
        if ($this->_productCollection->isLoaded()) {
            return $this->_productCollection;
        }
        $brand = $this->_request->getParam('brand');
        $this->_productCollection->addAttributeToSelect('*')
            ->addAttributeToFilter(
                [
                    ['attribute' => 'brand', 'eq' => $brand]
                ]
            );
        $this->_productCollection->load();
        return $this->_productCollection;
    }


}
