<?php
declare(strict_types = 1);

namespace Magebit\Faq\Controller\Adminhtml\Question;
use Magebit\Faq\Model\QuestionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Save extends Action
{
    /**
     * @var QuestionFactory
     */
    private $questionFactory;

    public function __construct(Context $context, QuestionFactory $questionFactory)
    {
        parent::__construct($context);
        $this->questionFactory = $questionFactory;
    }

    public function execute()
    {
        $this->questionFactory->create()
            ->setData($this->getRequest()->getPostValue())
            ->save();
        if ($this->getRequest()->getParam("back") == "edit") {
            return $this->resultRedirectFactory->create()->setPath("*/*/edit", ['id' => $this->getRequest()->getParam('id')]);
        }
        return $this->resultRedirectFactory->create()->setPath("faq/question/index");
    }
}
