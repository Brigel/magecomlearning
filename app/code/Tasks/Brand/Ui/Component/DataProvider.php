<?php

namespace Tasks\Brand\Ui\Component;


use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
//use Magento\Framework\Api\Search\SearchCriteria;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
//use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\App\RequestInterface;

class DataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider
{
    protected $brandCollection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        \Tasks\Brand\Model\ResourceModel\Brand\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
    $collection = $collectionFactory->create();
    $collection->addAttributeToSelect('*');
    $this->brandCollection = $collection;
    parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );
    }

    public function addField($field, $alias = null)
    {

    }
    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $data = parent::getData();
        $items = $this->brandCollection->exportToArray();
        $data['items'] = array_values($items);
        return $data;
    }
}