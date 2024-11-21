<?php

declare(strict_types=1);

namespace Iranimij\ProductLabels\Controller\Adminhtml\New;

use Magento\Backend\App\Action;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Save extends Action implements ButtonProviderInterface
{

    public function execute()
    {
        var_dump('sd');die();
    }

    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
