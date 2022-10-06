<?php

namespace Magebit\Faq\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Question extends AbstractDb
{
    protected $_idFieldName = "id";

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init("magebit_faq", "id");
    }
}
