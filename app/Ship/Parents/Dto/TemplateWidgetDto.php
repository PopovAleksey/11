<?php

namespace App\Ship\Parents\Dto;

use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

final class TemplateWidgetDto extends Mapper
{
    private ?int    $id            = null;
    private ?int    $templateId    = null;
    private ?int    $countElements = null;
    private ?string $showBy        = null;
    private ?Carbon $createAt      = null;
    private ?Carbon $updateAt      = null;

    /**
     * @param int|null $id
     * @return TemplateWidgetDto
     */
    public function setId(?int $id): TemplateWidgetDto
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $templateId
     * @return TemplateWidgetDto
     */
    public function setTemplateId(?int $templateId): TemplateWidgetDto
    {
        $this->templateId = $templateId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getTemplateId(): ?int
    {
        return $this->templateId;
    }

    /**
     * @param int|null $countElements
     * @return TemplateWidgetDto
     */
    public function setCountElements(?int $countElements): TemplateWidgetDto
    {
        $this->countElements = $countElements;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCountElements(): ?int
    {
        return $this->countElements;
    }

    /**
     * @param string|null $showBy
     * @return TemplateWidgetDto
     */
    public function setShowBy(?string $showBy): TemplateWidgetDto
    {
        $this->showBy = $showBy;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShowBy(): ?string
    {
        return $this->showBy;
    }

    /**
     * @param \Illuminate\Support\Carbon|null $createAt
     * @return TemplateWidgetDto
     */
    public function setCreateAt(?Carbon $createAt): TemplateWidgetDto
    {
        $this->createAt = $createAt;

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
     * @param \Illuminate\Support\Carbon|null $updateAt
     * @return TemplateWidgetDto
     */
    public function setUpdateAt(?Carbon $updateAt): TemplateWidgetDto
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getUpdateAt(): ?Carbon
    {
        return $this->updateAt;
    }


}