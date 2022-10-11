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
        $options = [];
        $availableOptions = [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];

        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }

        return $options;
    }
}
