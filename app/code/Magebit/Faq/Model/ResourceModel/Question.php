<?php
declare(strict_types = 1);

namespace Magebit\Faq\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magebit\Faq\Api\Data\QuestionInterface;

class Question extends AbstractDb
{
    protected $_idFieldName = QuestionInterface::IDFIELDNAME;

    /**
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init(QuestionInterface::TABLENAME, QuestionInterface::IDFIELDNAME);
    }
}
