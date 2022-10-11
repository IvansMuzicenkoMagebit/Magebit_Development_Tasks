<?php
declare(strict_types = 1);

namespace Magebit\Faq\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface QuestionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return Magebit\Faq\Api\Data\QuestionInterface[]
     */
    public function getItems();

    /**
     * @param Magebit\Faq\Api\Data\QuestionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
