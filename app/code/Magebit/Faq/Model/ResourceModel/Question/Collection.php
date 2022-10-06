<?php

namespace Magebit\Faq\Model\ResourceModel\Question;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Psr\Log\LoggerInterface as Logger;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'faq';
    protected $_eventObject = 'faq_collection';

    protected function _construct()
    {
        $this->_init('Magebit\Faq\Model\Question', 'Magebit\Faq\Model\ResourceModel\Question');
    }
}
