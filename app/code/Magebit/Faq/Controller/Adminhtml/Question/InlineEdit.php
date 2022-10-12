<?php
declare(strict_types = 1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\QuestionRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class InlineEdit extends Action
{
    /**
     * @var JsonFactory
     */
    protected $jsonFactory;


    /**
     * @var QuestionRepository
     */
    protected $questionRepository;

    public function __construct(
        Context     $context,
        JsonFactory $jsonFactory,
        QuestionRepository $questionRepository
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->questionRepository = $questionRepository;
    }

    /**
     * @throws NoSuchEntityException
     */
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
                foreach ($editItems as $id => $value) {
                    $modelData = $this->questionRepository->getById($id);

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
