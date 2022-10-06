<?php

namespace Magebit\Faq\Ui\Component\Form\Button;

use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;
use Magento\Ui\Component\Control\Container;

/**
 * Class Save
 */
class Save extends Generic
{
    /**
     * {@inheritdoc}
     */
    public function getButtonData()
    {
        if ($this->getProduct()->isReadonly()) {
            return [];
        }

        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'faq_question_form.faq_question_form',
                                'actionName' => 'save',
                                'params' => [
                                    false
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'class_name' => Container::SPLIT_BUTTON,
            'options' => $this->getOptions(),
        ];
    }

    /**
     * Retrieve options
     *
     * @return array
     */
    protected function getOptions()
    {

        $options[] = [
            'id_hard' => 'save_and_close',
            'label' => __('Save & Close'),
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'faq_question_form.faq_question_form',
                                'actionName' => 'save',
                                'params' => [
                                    true
                                ]
                            ]
                        ]
                    ]
                ]
            ],
        ];

        return $options;
    }
}
