<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\Stream;

/**
 * Class Message
 * @package Extended\Stream
 */
abstract class Message
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var int
     */
    protected $priority;

    /**
     * @var int
     */
    protected $inputTime;

    /**
     * Message constructor.
     * @param string $title
     * @param string $body
     * @param int $priority
     */
    public function __construct(string $title, string $body, int $priority = -1)
    {
        $this->title = $title;
        $this->body = $body;
        $this->priority = $priority;
        $this->inputTime = time();
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return int
     */
    public function getInputTime(): int
    {
        return $this->inputTime;
    }
}