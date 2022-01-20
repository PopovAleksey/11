<?php

namespace App\Containers\Core\Authentication\UI\WEB\Controllers;

use App\Containers\Core\Authentication\Actions\WebLoginActionInterface;
use App\Containers\Core\Authentication\Actions\WebLogoutActionInterface;
use App\Containers\Core\Authentication\UI\WEB\Requests\LoginRequest;
use App\Ship\Parents\Controllers\WebController;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class Controller extends WebController
{
    public function __construct(
        private WebLogoutActionInterface $logoutAction,
        private WebLoginActionInterface  $loginAction
    )
    {
    }

    public function showLoginPage(): Factory|View|Application
    {
        return view('core@authentication::login');
    }

    public function logout(): Redirector|Application|RedirectResponse
    {
        $this->logoutAction->run();

        return redirect('/');
    }

    /**
     * @param \App\Containers\Core\Authentication\UI\WEB\Requests\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \PopovAleksey\Mapper\MapperException
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $mappedRequest = $request->mapped();
            $userDto       = $this->loginAction->run($mappedRequest);
        } catch (Exception $e) {
            return redirect()->route(config('appSection-authentication.login-page-url'))->with('status', $e->getMessage());
        }

        return $userDto->getId() !== NULL
            ? redirect()->route(config('appSection-authentication.login-page-url'))->with($userDto->toArray())
            : redirect()->intended();
    }
}
