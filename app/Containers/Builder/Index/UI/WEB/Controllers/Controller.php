<?php

namespace App\Containers\Builder\Index\UI\WEB\Controllers;

use App\Containers\Builder\Index\Actions\BuildTemplateActionInterface;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Controller extends WebController
{
    public function __construct(
        private BuildTemplateActionInterface $buildTemplateAction
    )
    {
    }

    public function index(?string $language = null, ?string $seoLink = null): Factory|View|Application
    {
        $indices = $this->buildTemplateAction->run($language, $seoLink);

        dd(['language' => $language, 'link' => $seoLink]);
        #return view('constructor.base');
    }
}
