<?php

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
//use Magento\Tests\NamingConvention\true\string;
use Magento\Widget\Block\BlockInterface;

class PageList extends Template implements BlockInterface
{

    /**
     * construct description
     * @param MagentoFrameworkViewElementTemplateContext $context
     * @param \Magento\Cms\Api\PageRepositoryInterface $pageRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * $data[]
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
    public function getTitle()
    {
        return $this->getData('title');
    }

    /**
     * Get all selected pages HTML string function
     * @see \Magebit\PageListWidget\Block\Widget\PageList::getPagesList()
     * @return string
     */
    public function getSelectedPages()
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
    private function getPagesList()
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
    private function _getSearchCriteria()
    {
        return $this->_search->addFilter('is_active', '1')->create();
    }
}
