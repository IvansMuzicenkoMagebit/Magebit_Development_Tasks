<?php

namespace Magebit\Faq\Model\Question;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
    public function getData(): array
    {
        $result = [];
        foreach ($this->collection->getList() as $item) {
            $result[$item->getId()]["general"] = $item->getData();
        }
        return $result;
    }
}
