<?php

namespace Tasks\Brand\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

class Thumbnail extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $url = isset($item['url_pic'])?$item['url_pic']:'';
                $item[$fieldName . '_src'] = $url;
                $item[$fieldName . '_alt'] = $item['name'];
                $item[$fieldName . '_orig_src'] = $url;
            }
        }

        return $dataSource;
    }

}