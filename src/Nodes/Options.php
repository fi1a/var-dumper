<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Параметры
 */
class Options implements OptionsInterface
{
    /**
     * @var int
     */
    protected $maxNestedLevel;

    /**
     * @var int
     */
    protected $maxLength;

    /**
     * @var int
     */
    protected $maxCount;

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $config = config('fi1a/var-dumper');

        $this->setMaxNestedLevel((int) $config->getInt('maxNestedLevel', 5));
        $this->setMaxLength((int) $config->getInt('maxLength', 500));
        $this->setMaxCount((int) $config->getInt('maxCount', 50));
    }

    /**
     * @inheritDoc
     */
    public function setMaxNestedLevel(int $maxNestedLevel)
    {
        $this->maxNestedLevel = $maxNestedLevel;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getMaxNestedLevel(): int
    {
        return $this->maxNestedLevel;
    }

    /**
     * @inheritDoc
     */
    public function setMaxLength(int $maxLength)
    {
        $this->maxLength = $maxLength;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getMaxLength(): int
    {
        return $this->maxLength;
    }

    /**
     * @inheritDoc
     */
    public function setMaxCount(int $maxCount)
    {
        $this->maxCount = $maxCount;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getMaxCount(): int
    {
        return $this->maxCount;
    }
}
