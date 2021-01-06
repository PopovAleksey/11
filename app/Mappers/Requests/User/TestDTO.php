<?php

namespace App\Mappers\Requests\User;

use App\Mappers\Mapper;

/**
 * Class TestDTO
 * @package App\Mappers\Requests\User
 */
class TestDTO extends Mapper
{
    private ?string $hi     = null;
    private bool    $is;
    private ?int    $number = null;

    /**
     * @var \App\Mappers\Requests\User\TestDTO[]
     */
    protected array $exampleForArrayWithClass;

    /**
     * @return \App\Mappers\Requests\User\TestDTO[]
     */
    public function getExampleForArrayWithClass(): array
    {
        return $this->exampleForArrayWithClass;
    }

    /**
     * @param \App\Mappers\Requests\User\TestDTO[] $exampleForArrayWithClass
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
    public function getHi(): ?string
    {
        return $this->hi;
    }

    /**
     * @param string|null $hi
     * @return $this\
     */
    public function setHi(?string $hi): self
    {
        $this->hi = $hi;

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
