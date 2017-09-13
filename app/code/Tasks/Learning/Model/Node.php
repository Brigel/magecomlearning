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

/**
 * Class Node
 * @package Tasks\Learning\Model
 */
class Node extends \Magento\Framework\Data\Tree\Node
{
    /**
     * Node constructor.
     * @param array $data
     * @param string $idField
     * @param Tree $tree
     * @param null $parent
     */
    public function __construct(array $data, $idField, Tree $tree, $parent = null)
    {
        parent::__construct($data, $idField, $tree, $parent);
        $this->_childNodes = new \Tasks\Learning\Model\NodeCollection($this);
    }

    /**
     * This method adds a new child node at the first position of the children.
     *
     * @param \Magento\Framework\Data\Tree\Node $node
     * @return void
     */
    public function prependChild(\Magento\Framework\Data\Tree\Node $node)
    {
        $this->_childNodes->prepend_add($node);
        return $this;
    }
}