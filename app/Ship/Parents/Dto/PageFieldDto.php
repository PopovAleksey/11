<?php

namespace App\Ship\Parents\Dto;

use Exception;
use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

final class PageFieldDto extends Mapper
{
    private ?int    $id          = null;
    private ?int    $page_id     = null;
    private ?string $name        = null;
    private ?string $type        = null;
    private ?string $placeholder = null;
    private ?string $mask        = null;
    private ?array  $values      = null;
    private ?bool   $active      = null;
    private ?Carbon $createAt    = null;
    private ?Carbon $updateAt    = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return $this
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPageId(): ?int
    {
        return $this->page_id;
    }

    /**
     * @param int|null $page_id
     * @return $this
     */
    public function setPageId(?int $page_id): self
    {
        $this->page_id = $page_id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return $this
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }

    /**
     * @param string|null $placeholder
     * @return $this
     */
    public function setPlaceholder(?string $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMask(): ?string
    {
        return $this->mask;
    }

    /**
     * @param string|null $mask
     * @return $this
     */
    public function setMask(?string $mask): self
    {
        $this->mask = $mask;

        return $this;
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values ?? [];
    }

    /**
     * @return string
     */
    public function getInputValue(): string
    {
        return last($this->getValues());
    }

    /**
     * @return string
     */
    public function getListValue(): string
    {
        return implode(';', $this->getValues());
    }

    /**
     * @param array|string|null $values
     * @return $this
     */
    public function setValues(array|string|null $values): self
    {
        if (is_string($values)) {
            try {
                $this->values = json_decode($values, true, 512, JSON_THROW_ON_ERROR);
            } catch (Exception) {
                $this->values = null;
            }

            return $this;
        }

        $this->values = $values;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool|null $active
     * @return $this
     */
    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getCreateAt(): ?Carbon
    {
        return $this->createAt;
    }

    /**
     * @param \Illuminate\Support\Carbon|null $createAt
     * @return $this
     */
    public function setCreateAt(?Carbon $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getUpdateAt(): ?Carbon
    {
        return $this->updateAt;
    }

    /**
     * @param \Illuminate\Support\Carbon|null $updateAt
     * @return $this
     */
    public function setUpdateAt(?Carbon $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }
}