<?php
declare(strict_types = 1);

namespace Magebit\Faq\Block;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magebit\Faq\Api\QuestionRepositoryInterface;

class QuestionList extends Template
{

    /**
     * @param Template\Context $context
     * @param QuestionRepositoryInterface $questionRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        QuestionRepositoryInterface $questionRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_faqList = $questionRepository;
        $this->_search = $searchCriteriaBuilder;
    }
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('question-list.phtml');
    }

    /**
     * @return \Magento\Framework\Api\SearchCriteria
     */
    private function _getSearchCriteria():SearchCriteria
    {
        return $this->_search->addFilter('status', '1')->create();
    }


    /**
     * Get all pages array function
     * @return array
     * @throws LocalizedException
     */
    public function getFaqList():array
    {
        $list = [];
        foreach ($this->_faqList->getList($this->_getSearchCriteria())->getItems() as $item) {
            $list[] = $item;
        }
        return $list;
    }


}

