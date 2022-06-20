<?php

namespace App\Containers\Core\Authentication\UI\WEB\Controllers;

use App\Containers\Core\Authentication\Actions\GoogleOAuth\GetAuthLinkActionInterface;
use App\Containers\Core\Authentication\Actions\GoogleOAuth\SignInActionInterface;
use App\Containers\Core\Authentication\Actions\WebLogoutActionInterface;
use App\Ship\Parents\Controllers\WebController;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class Controller extends WebController
{
    public function __construct(
        private WebLogoutActionInterface   $logoutAction,
        private GetAuthLinkActionInterface $getGoogleAuthLinkAction,
        private SignInActionInterface      $googleSignInAction
    )
    {
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function showLoginPage(): View|Factory|Application|RedirectResponse
    {
        if (!request()?->secure()) {
            return redirect()->secure(request()?->getRequestUri() ?? route('login'));
        }

        try {
            $googleLink = $this->getGoogleAuthLinkAction->run();
        }catch (Exception){
            $googleLink = false;
        }

        return view('core@authentication::login', [
            'googleAuthLink' => $googleLink,
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \PopovAleksey\Mapper\MapperException
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
     * @return \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function logout(): Redirector|Application|RedirectResponse
    {
        $this->logoutAction->run();

        return redirect('/');
    }
}
