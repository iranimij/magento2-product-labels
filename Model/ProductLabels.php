<?php

namespace Iranimij\ProductLabels\Model;

use Magento\Framework\Model\AbstractModel;

class ProductLabels extends AbstractModel
{
    public function _construct()
    {
        $this->_init(\Iranimij\ProductLabels\Model\ResourceModel\ProductLabels::class);
    }
}
