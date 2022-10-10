<?php

namespace Magebit\Faq\Ui\Component\Form\Button;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\App\Action;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Back extends Action implements ButtonProviderInterface
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
     *
     * @return string
     */
    private function getBackUrl()
    {
        return $this->getUrl(
            'faq/question/index'
        );
    }

    public function execute()
    {
    }
}
