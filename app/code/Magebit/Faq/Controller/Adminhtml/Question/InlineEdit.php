<?php
declare(strict_types = 1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\QuestionRepository;
use Magebit\Faq\Model\Question;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends Action
{
    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var Question
     */
    protected $model;

    /**
     * @var QuestionRepository
     */
    protected $questionRepository;

    public function __construct(
        Context     $context,
        JsonFactory $jsonFactory,
        Question $model,
        QuestionRepository $questionRepository
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->model = $model;
        $this->questionRepository = $questionRepository;
    }

    public function execute()
    {
        $error = false;
        $messages = [];
        $resultJson = $this->jsonFactory->create();

        if ($this->getRequest()->getParam('isAjax')) {
            $editItems = $this->getRequest()->getParam('items', []);

            if (empty($editItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($editItems) as $id) {
                    $modelData = $this->model->load($id);

                    try {
                        $modelData->setData(array_merge($modelData->getData(), $editItems[$id]));
                        $this->questionRepository->save($modelData);
                    } catch (\Exception $e) {
                        $messages[] = "[Error:]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
