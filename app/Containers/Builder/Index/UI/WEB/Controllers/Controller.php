<?php

namespace App\Containers\Builder\Index\UI\WEB\Controllers;

use App\Containers\Builder\Index\Actions\IndexBuilderActionInterface;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Controller extends WebController
{
    public function __construct(
        private IndexBuilderActionInterface $getAllIndicesAction
    )
    {
    }

    public function index(?string $language = null, ?string $seoLink = null): Factory|View|Application
    {
        $indices = $this->getAllIndicesAction->run();

        dd('This is Index page', ['language' => $language, 'link' => $seoLink]);
        #return view('constructor.base');
    }
}
