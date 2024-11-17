<?php

declare(strict_types=1);

namespace Iranimij\ProductLabels\Ui\DataProvider\Category\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    protected function _initSelect(): void
    {
//        $this->addFilterToMap('entity_id', 'main_table.label_id');
//        $this->addFilterToMap('name', 'devgridname.value');
        parent::_initSelect();
    }
}
