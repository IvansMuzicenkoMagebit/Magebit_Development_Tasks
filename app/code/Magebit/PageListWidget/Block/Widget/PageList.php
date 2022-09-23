<?php
declare(strict_types = 1);

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class PageList extends Template implements BlockInterface
{

    /**
     * @param Template\Context $context
     * @param \Magento\Cms\Api\PageRepositoryInterface $pageRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Cms\Api\PageRepositoryInterface $pageRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_cmsPage = $pageRepository;
        $this->_search = $searchCriteriaBuilder;
    }
    /**
     * construct function
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('page-list.phtml');
    }

    /**
     * Get title function
     * @return string
     */
    public function getTitle():string
    {
        return $this->getData('title');
    }

    /**
     * Get all selected pages HTML string function
     * @see \Magebit\PageListWidget\Block\Widget\PageList::getPagesList()
     * @return string
     */
    public function getSelectedPages():string
    {
        $newPagesArray = [];
        if ($this->getData("display_mode") == "all") {
            $newPagesArray =  $this->getPagesList();
        } else {
            // Create new array of pages in needed format
            $pagesArray = explode(",", $this->getData('selected_pages'));
            foreach ($pagesArray as $page) {
                $newPagesArray[$page] = $this->getPagesList()[$page];
            }
        }

        // Convert pages array to HTML string
        $pagesHtml = "";
        foreach ($newPagesArray as $url => $title) {
            $pagesHtml .= "<li><a href='" . $url . "'>" . $title . "</a></li>";
        }

        return $pagesHtml;
    }

    /**
     * Get all pages array function
     * @return array
     * @throws LocalizedException
     */
    private function getPagesList():array
    {
        $pages = [];
        foreach ($this->_cmsPage->getList($this->_getSearchCriteria())->getItems() as $page) {
            $pages[$page->getIdentifier()] = $page->getTitle();
        }
        return $pages;
    }

    /**
     * @return \Magento\Framework\Api\SearchCriteria
     */
    private function _getSearchCriteria():SearchCriteria
    {
        return $this->_search->addFilter('is_active', '1')->create();
    }
}
