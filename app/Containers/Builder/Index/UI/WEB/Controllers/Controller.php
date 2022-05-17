<?php

namespace App\Containers\Builder\Index\UI\WEB\Controllers;

use App\Containers\Builder\Index\Actions\BuildTemplateActionInterface;
use App\Containers\Builder\Index\Actions\GetContentCssOrJsActionInterface;
use App\Ship\Parents\Controllers\WebController;
use JetBrains\PhpStorm\NoReturn;

class Controller extends WebController
{
    public function __construct(
        private BuildTemplateActionInterface     $buildTemplateAction,
        private GetContentCssOrJsActionInterface $getContentCssOrJsAction
    )
    {
    }

    /**
     * @param string|null $language
     * @param string|null $seoLink
     * @return string
     */
    public function index(?string $language = null, ?string $seoLink = null): string
    {
        return $this->buildTemplateAction->run($language, $seoLink);
    }

    /**
     * @param string $themeName
     * @param string $type
     * @param string $fileName
     * @return void
     */
    #[NoReturn]
    public function file(string $themeName, string $type, string $fileName): void
    {
        $file = $this->getContentCssOrJsAction->run($themeName, $type, $fileName);

        header("Access-Control-Allow-Methods: GET");
        header('Content-Type: ' . $file->get('type'));

        echo $file->get('content');
        die;
    }
}
