<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Cms\Controller\Adminhtml\Block;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;

/**
 * Class MassDelete
 */
class MassDelete extends Action implements HttpPostActionInterface
{
//    /**
//     * Authorization level of a basic admin session
//     *
//     * @see _isAllowed()
//     */
//    const ADMIN_RESOURCE = 'Magento_Cms::block';

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var QuestionCollectionFactory
     */
    protected $questionCollectionFactory;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param QuestionCollectionFactory $questionCollectionFactory
     */
    public function __construct(Context $context, Filter $filter, QuestionCollectionFactory $questionCollectionFactory)
    {
        $this->filter = $filter;
        $this->questionCollectionFactory = $questionCollectionFactory;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->questionCollectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $block) {
            $block->delete();
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('/faq');
    }
}
