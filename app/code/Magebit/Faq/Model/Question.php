<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\Model\AbstractModel;

class Question extends AbstractModel implements QuestionInterface
{
    protected function _construct()
    {
        $this->_init("Magebit\Faq\Model\ResourceModel\Question");
    }

    public function getId()
    {
        return $this->_getData("id");
    }

    public function getQuestion(): string
    {
        return $this->_getData("question");
    }

    public function setQuestion(string $question): void
    {
        $this->setData("question", $question);
    }

    public function getAnswer(): string
    {
        return $this->_getData("answer");
    }

    public function setAnswer(string $answer): void
    {
        $this->setData("answer", $answer);
    }

    public function getStatus(): int
    {
        return $this->_getData("status");
    }

    public function setStatus(int $status): void
    {
        $this->setData("status", $status);
    }

    public function getPosition(): int
    {
        return $this->_getData("position");
    }

    public function setPosition(int $position): void
    {
        $this->setData("position", $position);
    }

    public function getUpdatedAt(): string
    {
        return $this->_getData("updatedat");
    }
}
