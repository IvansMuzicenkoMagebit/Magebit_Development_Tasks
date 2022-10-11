<?php
declare(strict_types = 1);

namespace Magebit\Faq\Model\Question;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var \Magebit\Faq\Model\ResourceModel\Question\CollectionFactory
     */
    protected $collection;

    /**
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $result = [];
        foreach ($this->collection->getItems() as $item) {
            $result[$item->getId()] = $item->getData();
        }
        return $result;
    }
}
