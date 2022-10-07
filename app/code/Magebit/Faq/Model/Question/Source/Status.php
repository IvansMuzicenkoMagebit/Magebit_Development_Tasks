<?php

namespace Magebit\Faq\Model\Question\Source;

class Status implements \Magento\Framework\Option\ArrayInterface
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public function toOptionArray()
    {
        return [
            [
                self::STATUS_ENABLED => __('Enabled'),
                self::STATUS_DISABLED => __('Disabled'),
            ],
        ];
    }
    public static function getOptionArray()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}
