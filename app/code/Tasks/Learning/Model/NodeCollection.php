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

use Magento\Framework\Data\Tree;
use Magento\Framework\Data\Tree\Node;

/**
 * Class NodeCollection
 * @package Tasks\Learning\Model
 */
class NodeCollection extends \Magento\Framework\Data\Tree\Node\Collection
{
    /**
     * Adds a node to this node
     * @param Node $node
     * @return Node
     */
    public function prepend_add(Node $node)
    {
        $reflect = new \ReflectionClass(get_parent_class($this));
        $_nodes = $reflect->getProperty('_nodes');
        $_nodes->setAccessible(true);
        $nodesData = $_nodes->getValue($this);
        $nodesData = array($node->getId() => $node) + $nodesData;
        $_nodes->setValue($this, $nodesData);
        return $this;
    }

}