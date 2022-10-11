<?php
declare(strict_types = 1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
     public function execute()
     {
         return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
     }
}
