<?php

namespace App\Ship\Parents\Repositories;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

interface TemplateWidgetRepositoryInterface
{
    public function getWidgetContents(int $widgetTemplateId, int $languageId, Collection $contentIds): EloquentCollection;
}