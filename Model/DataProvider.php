<?php

declare(strict_types=1);

namespace Iranimij\ProductLabels\Model;

use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Iranimij\ProductLabels\Model\ResourceModel\ProductLabels\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @param string            $name
     * @param string            $primaryFieldName
     * @param string            $requestFieldName
     * @param CollectionFactory $employeeCollectionFactory
     * @param array             $meta
     * @param array             $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $employeeCollectionFactory,
        private readonly ProductLabels $productLabels,
        private readonly RequestInterface $request,
        array $meta = [],
        array $data = [],

    ) {
        $this->collection = $employeeCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        $LabelId = $this->request->getParam('id');
        $data    = $this->productLabels->load($LabelId);

        return [
            $LabelId => [
                'label_id' => $LabelId,
                'text' => $data->getData('text'),
                'text_color' => $data->getData('text_color'),
                'text_background_color' => $data->getData('text_background_color'),
            ]
        ];
    }
}
