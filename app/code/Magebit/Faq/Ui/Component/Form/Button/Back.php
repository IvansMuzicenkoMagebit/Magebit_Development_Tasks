<?php

namespace Magebit\Faq\Ui\Component\Form\Button;

use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;

class Back extends Generic
{
    /**
     * Get Button Data
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
    /**
     * Get URL for back
     *
     * @return string
     */
    private function getBackUrl()
    {
        if ($this->context->getRequestParam('customerId')) {
            return $this->getUrl(
                'customer/index/edit',
                ['id' => $this->context->getRequestParam('customerId')]
            );
        }
        return $this->getUrl('*/*/');
    }
}
