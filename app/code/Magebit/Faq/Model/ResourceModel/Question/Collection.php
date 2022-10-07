<?php

namespace Magebit\Faq\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
//    protected $_idFieldName = 'id';
//    protected $_eventPrefix = 'faq';
//    protected $_eventObject = 'faq_collection';

    protected function _construct()
    {
        $this->_init('Magebit\Faq\Model\Question', 'Magebit\Faq\Model\ResourceModel\Question');
    }
}
