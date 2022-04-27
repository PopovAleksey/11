<?php

namespace App\Ship\Parents\Dto;

use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

final class MenuDto extends Mapper
{
    private ?int    $id         = null;
    private ?int    $content_id = null;
    private ?string $name       = null;
    private ?bool   $inMenu     = null;
    private ?int    $order      = null;
    private ?Carbon $createAt   = null;
    private ?Carbon $updateAt   = null;

    /**
     * @return int
     */
    public function getId(): int
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
    public function getContentId(): ?int
    {
        return $this->content_id;
    }

    /**
     * @param int|null $content_id
     * @return $this
     */
    public function setContentId(?int $content_id): self
    {
        $this->content_id = $content_id;

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
     * @return bool|null
     */
    public function isInMenu(): ?bool
    {
        return $this->inMenu;
    }

    /**
     * @param bool|null $inMenu
     * @return $this
     */
    public function setInMenu(?bool $inMenu): self
    {
        $this->inMenu = $inMenu;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOrder(): ?int
    {
        return $this->order;
    }

    /**
     * @param int|null $order
     * @return $this
     */
    public function setOrder(?int $order): self
    {
        $this->order = $order;

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