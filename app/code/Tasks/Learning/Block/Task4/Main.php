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

namespace Tasks\Learning\Block\Task4;

/**
 * Class Main
 * @package Tasks\Learning\Block\Task4
 */
class Main extends \Magento\Framework\View\Element\Template
{
    /**
     * @param string $currentFile file where execute this method
     */
    public function printOtherLinksToTemplates($currentFile)
    {
        $links = $this->getOtherLinks($currentFile);
        foreach ($links as $link) {
            $name = $link["name"];
            $url = $link["url"];
            echo "<a href='$url'>Go to: $name</a><br>";
        }
    }

    /**
     * @var array $templates
     */
    protected $templates = [
        'front_base',
        'front_index',
        'index_base',
        'index_index',
    ];

    /**
     * @param $currentFile
     * @return array urls and names for print to page
     */
    public function getOtherLinks($currentFile)
    {
        $currentFile = $fileName = pathinfo($currentFile, PATHINFO_FILENAME);;
        $urls = [];
        foreach ($this->templates as $nameFile) {
            if ($currentFile == $nameFile) {
                continue;
            }

            $urlControllerAction = str_replace('_', '/', $nameFile);

            $route = $this->getRequest()->getRouteName();
            $url = $route . '/' . $urlControllerAction;

            $nameLink = str_replace('_', ' ', $nameFile);

            array_push($urls, ["name" => $nameLink, "url" => $this->getUrl($url)]);
        }

        return $urls;
    }
}