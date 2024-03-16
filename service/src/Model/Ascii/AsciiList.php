<?php

namespace App\Model\Ascii;

class AsciiList
{
    /**
     * @var array<string>
     */
    private array $originalList;
    /**
     * @var array<string>
     */
    private array $resultList;
    /**
     * @var array<string>
     */
    private array $difference;

    public function __construct()
    {
        $this->originalList = $this->resultList = range(',', '|');
    }

    /**
     * @param array<string> $originalList
     * @return $this
     */
    public function setOriginalList(array $originalList): self
    {
        $this->originalList = $originalList;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getOriginalList(): array
    {
        return $this->originalList;
    }

    /**
     * @param array<string> $resultList
     * @return $this
     */
    public function setResultList(array $resultList): self
    {
        $this->resultList = $resultList;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getResultList(): array
    {
        return $this->resultList;
    }

    /**
     * @param array<string> $difference
     * @return $this
     */
    public function setDifference(array $difference): self
    {
        $this->difference = $difference;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getDifference(): array
    {
        return $this->difference;
    }
}
