<?php
declare(strict_types = 1);

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\Model\AbstractModel;

class Question extends AbstractModel implements QuestionInterface
{
    protected function _construct()
    {
        $this->_init("Magebit\Faq\Model\ResourceModel\Question");
    }

    /**
     * @return int|mixed|null
     */
    public function getId()
    {
        return $this->_getData("id");
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->_getData("question");
    }

    /**
     * @param string $question
     * @return void
     */
    public function setQuestion(string $question): void
    {
        $this->setData("question", $question);
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->_getData("answer");
    }

    /**
     * @param string $answer
     * @return void
     */
    public function setAnswer(string $answer): void
    {
        $this->setData("answer", $answer);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->_getData("status");
    }

    /**
     * @param int $status
     * @return void
     */
    public function setStatus(int $status): void
    {
        $this->setData("status", $status);
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->_getData("position");
    }

    /**
     * @param int $position
     * @return void
     */
    public function setPosition(int $position): void
    {
        $this->setData("position", $position);
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->_getData("updatedat");
    }
}
