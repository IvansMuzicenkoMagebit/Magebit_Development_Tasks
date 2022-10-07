<?php

namespace Magebit\Faq\Model\Question;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var \Magebit\Faq\Model\ResourceModel\Question\CollectionFactory
     */
    protected $collection;

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
    public function getData(): array
    {
        $result = [];
        foreach ($this->collection->getItems() as $item) {
            $result[$item->getId()]["general"] = $item->getData();
        }
        return $result;
//        if (isset($this->loadedData)) {
//            return $this->loadedData;
//        }
//        /** @var \Magebit\Faq\Model\Question $item */
//        foreach ($this->collection->getItems() as $item) {
//            $this->loadedData[$item->getId()] = $item->getData();
//        }
//
//        return $this->loadedData;
    }
}
