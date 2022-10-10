<?php
declare(strict_types = 1);
namespace Magebit\PageListWidget\Model\Config\Source;

use Magento\Cms\Api\Data\PageInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

/**
 * Class CmsPages
 * @package Magebit\PageListWidget\Model\Config\Source
 */
class CmsPages implements OptionSourceInterface
{
    /**
     * @var PageRepositoryInterface
     */
    private $pageRepositoryInterface;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * CmsPages constructor.
     * @param PageRepositoryInterface $pageRepositoryInterface
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param LoggerInterface $logger
     */
    public function __construct(
        PageRepositoryInterface $pageRepositoryInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        LoggerInterface $logger
    ) {
        $this->pageRepositoryInterface = $pageRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->logger = $logger;
    }

    /**
     * Get all pages option array function
     * @return array
     */
    public function toOptionArray():array
    {
        $optionArray = [];
        try {
            $pages = $this->getCmsPages();

            foreach ($pages as $page) {
                $data = [];
                $data['value'] = $page->getIdentifier();
                $data['label'] = $page->getTitle();
                $optionArray[] = $data;
            }
        } catch (\Exception $e) {
            $this->logger->critical('Error message', ['exception' => $e]);
        }
        return $optionArray;
    }

    /**
     * Get all pages array function
     * @return \Exception|PageInterface[]|LocalizedException
     */
    public function getCmsPages():LocalizedException
    {
        $searchCriteria = $searchCriteria = $this->searchCriteriaBuilder->create();
        try {
            $cmsPagesList = $this->pageRepositoryInterface->getList($searchCriteria)->getItems();
        } catch (LocalizedException $e) {
            return $e;
        }
        return $cmsPagesList;
    }
}
