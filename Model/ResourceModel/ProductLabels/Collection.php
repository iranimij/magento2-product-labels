<?php

declare(strict_types=1);

namespace Iranimij\ProductLabels\Model\ResourceModel\ProductLabels;

use Iranimij\ProductLabels\Model\ProductLabels as Model;
use Iranimij\ProductLabels\Model\ResourceModel\ProductLabels as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
