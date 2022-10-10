<?php

namespace Magebit\Faq\Model\ResourceModel\Question\Grid;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Psr\Log\LoggerInterface as Logger;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Resource initialization.
     */
    protected $_idFieldName = 'id';

    protected $_eventPrefix = 'faq';

    protected $_eventObject = 'faq_collection';

    protected function _construct()
    {
        $this->_init(Magebit\Faq\Model\Question::class, Magebit\Faq\Model\ResourceModel\Question::class);
    }

    public function getSelectCountSql()
    {
        $countSelect = parent::getSelectCountSql();
        $countSelect->reset(\Zend_Db_Select::GROUP);
        return $countSelect;
    }

    protected function _toOptionArray($valueField = 'id', $labelField = 'id', $additional = [])
    {
        return parent::_toOptionArray($valueField, $labelField, $additional);
    }

    public function addFieldToSearchFilter($field, $condition = null)
    {
        $field = $this->_getMappedField($field);
        $this->_select->orWhere($this->_getConditionSql($field, $condition));
        return $this;
    }

}
