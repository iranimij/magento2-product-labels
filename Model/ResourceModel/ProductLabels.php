<?php

namespace Iranimij\ProductLabels\Model\ResourceModel;

use Magento\Catalog\Model\ResourceModel\AbstractResource;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ProductLabels extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('iranimij_product_labels', 'label_id');
    }
}
