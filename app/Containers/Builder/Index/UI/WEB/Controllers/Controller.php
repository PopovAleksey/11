<?php

namespace App\Containers\Builder\Index\UI\WEB\Controllers;

use App\Containers\Builder\Index\Actions\BuildTemplateActionInterface;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\Parents\Models\TemplateInterface;
use Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Controller extends WebController
{
    public function __construct(
        private BuildTemplateActionInterface $buildTemplateAction
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
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function cssFile(string $themeName, string $type, string $fileName): string
    {
        $folder = match ($type) {
            TemplateInterface::CSS_TYPE => config('constructor-template.folderName.css'),
            TemplateInterface::JS_TYPE => config('constructor-template.folderName.js')
        };

        $contentType = match ($type) {
            TemplateInterface::CSS_TYPE => 'text/css',
            TemplateInterface::JS_TYPE => 'text/javascript'
        };

        $commonFile = implode('/', [$themeName, $folder, $fileName]);
        $storage    = Storage::disk('template');

        if ($storage->exists($commonFile)) {
            header("Access-Control-Allow-Methods: GET");
            header('Content-Type: ' . $contentType);
            echo $storage->get($commonFile);
            die;
        }

        throw new NotFoundHttpException();
    }
}
