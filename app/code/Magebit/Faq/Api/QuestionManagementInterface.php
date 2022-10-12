<?php
declare(strict_types = 1);

namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionInterface;

interface QuestionManagementInterface
{
    /**
     * @param $item
     * @return void
     */
    public function enableQuestion($item):void;

    /**
     * @param $item
     * @return void
     */
    public function disableQuestion($item):void;
}
