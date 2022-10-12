<?php
declare(strict_types = 1);

namespace Magebit\Faq\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magebit\Faq\Api\Data\QuestionInterface;

class Collection extends AbstractCollection
{
    protected $_idFieldName = QuestionInterface::IDFIELDNAME;
    protected $_eventPrefix = 'faq';
    protected $_eventObject = 'faq_collection';

    protected function _construct()
    {
        $this->_init('Magebit\Faq\Model\Question', 'Magebit\Faq\Model\ResourceModel\Question');
    }
}
