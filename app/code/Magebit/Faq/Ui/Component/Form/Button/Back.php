<?php
declare(strict_types = 1);

namespace Magebit\Faq\Ui\Component\Form\Button;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\App\Action;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Back extends Action implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData(): array
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
    private function getBackUrl(): string
    {
        return $this->getUrl(
            'faq/question/index'
        );
    }

    public function execute()
    {
    }
}
