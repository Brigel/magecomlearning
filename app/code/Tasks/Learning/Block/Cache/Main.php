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

namespace Tasks\Learning\Block\Cache;

use Magento\Framework\View\Element\Template;

/**
 * Class Main
 * @package Tasks\CostumeCache\Block
 */
class Main extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Tasks\Learning\Model\Cache\CustomCache
     */
    protected $customCache;

    /**
     * Main constructor.
     * @param Template\Context $context
     * @param array $data
     * @param \Tasks\Learning\Model\Cache\CustomCache $testCache
     */
    public function __construct(
        Template\Context $context,
        array $data = [],
        \Tasks\Learning\Model\Cache\CustomCache $testCache
    )
    {
        $this->customCache = $testCache;
        parent::__construct($context, $data);
    }

    /**
     * Get cached content or sample content if not cached
     */
    public function getCachedContent()
    {
        $pageContentFromCache = $this->customCache->load('page_content');
        if(!empty($pageContentFromCache)){
            echo $pageContentFromCache;
        }else{
            echo 'Not cached content and add to cache new content! ';
            $this->customCache->save('<h2>CACHED CONTENT!!!<h2/>','page_content');
        }
    }

}