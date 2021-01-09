<?php

namespace App\Mappers;


/**
 * Class TestDTO
 * @package App\Mappers\Requests\User
 */
class TestDTO extends Mapper
{
    private ?string $string = null;
    private bool    $is;
    private ?int    $number = null;

    /**
     * @var \App\Mappers\TestDTO[]
     */
    protected array $exampleForArrayWithClass;

    /**
     * @return \App\Mappers\TestDTO[]
     */
    public function getExampleForArrayWithClass(): array
    {
        return $this->exampleForArrayWithClass;
    }

    /**
     * @param \App\Mappers\TestDTO[] $exampleForArrayWithClass
     * @return $this
     */
    public function setExampleForArrayWithClass(array $exampleForArrayWithClass): self
    {
        $this->exampleForArrayWithClass = $exampleForArrayWithClass;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getString(): ?string
    {
        return $this->string;
    }

    /**
     * @param string|null $string
     * @return $this\
     */
    public function setString(?string $string): self
    {
        $this->string = $string;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIs(): ?bool
    {
        return $this->is;
    }

    /**
     * @param bool $is
     * @return $this
     */
    public function setIs(bool $is): self
    {
        $this->is = $is;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int|null $number
     * @return $this
     */
    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }


}
