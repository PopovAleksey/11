<?php

/*
|--------------------------------------------------------------------------
| Ship Helpers
|--------------------------------------------------------------------------
|
| Write only general helper functions here.
| Container specific helper functions should go into their own related Containers.
| All files under app/{section_name}/{container_name}/Helpers/ folder will be autoloaded by Apiato.
|
*/

use Apiato\Core\Foundation\Facades\Apiato;

if (!function_exists('callFromContainer')) {
    /**
     * @param string $call = 'Section@Container::ActionInterface'
     * @return mixed
     */
    function callAction(string $call): mixed
    {
        preg_match("/^(\w+)@(\w+)::(\w+)$/", $call, $matches);
        $section   = data_get($matches, 1);
        $container = data_get($matches, 2);
        $action    = data_get($matches, 3);

        if (!in_array($section, Apiato::getSectionNames(), true)) {
            return null;
        }

        if (!in_array($container, Apiato::getSectionContainerNames($section), true)) {
            return null;
        }

        preg_match("/^(\w+)ActionInterface$/", $action, $matches);

        if (empty($matches)) {
            return null;
        }

        return app("App\Containers\\$section\\$container\Actions\\$action")->run();
    }
}