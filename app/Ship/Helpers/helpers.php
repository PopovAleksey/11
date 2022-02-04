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
if (!function_exists('callFromContainer')) {
    /**
     * @format Section@Container::interfaceClassName
     *
     * @return mixed
     */
    function callAction(string $call)
    {
        #return app("App\Containers\\$section\\$container\Actions\\$interfaceClasName")->run();
    }
}