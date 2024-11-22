<?php

declare(strict_types=1);

namespace Iranimij\ProductLabels\Controller\Adminhtml\New;

use \Iranimij\ProductLabels\Model\ProductLabelsFactory as ProductLabels;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Save extends Action implements ButtonProviderInterface
{
    public function __construct(
        Context $context,
        private readonly RequestInterface $request,
        private readonly ProductLabels $productLabels,
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $productLabel = $this->productLabels->create();
        $productLabel->setData($this->request->getParams());
        $productLabel->save();

        // redirect to a url
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('iranimij_product_labels/index/index');

        return $resultRedirect;
    }

    public function getButtonData()
    {
        return [
            'label'          => __('Save'),
            'class'          => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order'     => 90,
        ];
    }
}
