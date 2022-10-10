<?php
namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionInterface;

interface QuestionManagementInterface
{
    /**
     * @param int $id
     * @return void
     */
    public function enableQuestion(int $id):void;

    /**
     * @param int $id
     * @return void
     */
    public function disableQuestion(int $id):void;
}
