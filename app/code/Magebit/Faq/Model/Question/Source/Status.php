<?php
declare(strict_types = 1);

namespace Magebit\Faq\Model\Question\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            ["label" => __('Enabled'), "value" => self::STATUS_ENABLED],
            ["label" => __('Disabled'), "value" => self::STATUS_DISABLED]
        ];
    }
}
