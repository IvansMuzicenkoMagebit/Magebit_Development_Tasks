<?php

namespace Magebit\Faq\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface QuestionInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getId();


    /**
     * @return string
     */
    public function getQuestion():string;

    /**
     * @param string $question
     * @return void
     */
    public function setQuestion(string $question):void;

    /**
     * @return string
     */
    public function getAnswer():string;

    /**
     * @param string $answer
     * @return void
     */
    public function setAnswer(string $answer):void;

    /**
     * @return int
     */
    public function getStatus():int;

    /**
     * @param int $status
     * @return void
     */
    public function setStatus(int $status):void;

    /**
     * @return int
     */
    public function getPosition():int;

    /**
     * @param int $position
     * @return void
     */
    public function setPosition(int $position):void;

    /**
     * @return string
     */
    public function getUpdatedAt():string;
}
