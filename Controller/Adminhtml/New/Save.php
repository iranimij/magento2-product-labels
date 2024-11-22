<?php

declare(strict_types=1);

namespace Iranimij\ProductLabels\Controller\Adminhtml\New;

use Iranimij\ProductLabels\Model\ProductLabels;
use Iranimij\ProductLabels\Model\ProductLabelsFactory as ProductLabelsFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Save extends Action implements ButtonProviderInterface
{
    public function __construct(
        Context $context,
        private readonly RequestInterface $request,
        private readonly ProductLabelsFactory $productLabelsFactory,
        private readonly ProductLabels $productLabels,
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $labelId = $this->request->getParam('label_id');
        $data    = $this->request->getParams();
        try {
            if ($labelId) {
                $productLabel = $this->productLabels->load($labelId);
            } else {
                $productLabel = $this->productLabelsFactory->create();
                unset($data['label_id']);
            }
            $productLabel->setData($data)->save();
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

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
