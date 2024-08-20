<?php

namespace App\Containers\Core\Authentication\UI\WEB\Controllers;

use App\Containers\Core\Authentication\Actions\GoogleOAuth\GetAuthLinkActionInterface;
use App\Containers\Core\Authentication\Actions\GoogleOAuth\SignInActionInterface;
use App\Containers\Core\Authentication\Actions\WebLogoutActionInterface;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use PopovAleksey\Mapper\MapperException;

class Controller extends WebController
{
    public function __construct(
        private readonly WebLogoutActionInterface   $logoutAction,
        private readonly GetAuthLinkActionInterface $getGoogleAuthLinkAction,
        private readonly SignInActionInterface      $googleSignInAction
    )
    {
    }

    /**
     * @return View|Factory|Application|RedirectResponse
     */
    public function showLoginPage(): View|Factory|Application|RedirectResponse
    {
        if (!request()?->secure()) {
            return redirect()->secure(request()?->getRequestUri() ?? route('login'));
        }

        return view('core@authentication::login', [
            'googleAuthLink' => $this->getGoogleAuthLinkAction->run(),
            'facebookAuthLink' => $this->getGoogleAuthLinkAction->run(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws MapperException
     */
    public function googleCallback(Request $request): RedirectResponse
    {
        $code = $request->get('code');

        if ($code === null) {
            response()->json()->setStatusCode(401);
        }

        $userDto = $this->googleSignInAction->run($code);

        return $userDto->getId() !== null
            ? redirect()->route(config('appSection-authentication.login-page-url'))->with($userDto->toArray())
            : redirect()->intended();
    }

    /**
     * @return Redirector|Application|RedirectResponse
     */
    public function logout(): Redirector|Application|RedirectResponse
    {
        $this->logoutAction->run();

        return redirect('/');
    }
}
