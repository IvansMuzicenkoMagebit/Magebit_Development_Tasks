<?php
declare(strict_types = 1);

namespace Magebit\Faq\Model\Question\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magebit\Faq\Api\Data\QuestionInterface;

class Status implements OptionSourceInterface
{
    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            ["label" => __('Enabled'), "value" => QuestionInterface::ENABLED],
            ["label" => __('Disabled'), "value" => QuestionInterface::DISABLED]
        ];
    }
}
