<?php

namespace App\Containers\Builder\Index\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Models\TemplateInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetContentCssOrJsAction extends Action implements GetContentCssOrJsActionInterface
{
    /**
     * @param string $themeName
     * @param string $type
     * @param string $fileName
     * @return \Illuminate\Support\Collection
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function run(string $themeName, string $type, string $fileName): Collection
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

        if ($storage->exists($commonFile) === false) {
            throw new NotFoundHttpException();
        }

        return collect([
            'type'    => $contentType,
            'content' => $storage->get($commonFile),
        ]);
    }
}
