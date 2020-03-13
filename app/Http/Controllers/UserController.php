<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public const RESPONSE
        = <<<SCRIPT
<script>
    var message = JSON.stringify({type: 'oauth.pizza', success: %s})
    opener.postMessage(message,'*');
    window.close();
</script>
SCRIPT;

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information
     *
     * @param  string  $provider
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $oauth = Socialite::driver('google')->user();

        $this->user = $this->user::firstOrNew(
            [
                'google_id' => $oauth->getId(),
            ],
            [
                'name' => $oauth->getName(),
            ]
        );

        // Log user In
        Auth::guard()->login($this->user, true);

        return response(
            sprintf(self::RESPONSE, 'true')
        );
    }

    public function getUserData()
    {
        return $this->success(Auth::user());
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();

        $request->session()->invalidate();

        return $this->success();
    }

    public function getOrders()
    {
        return $this->success(Auth::user()->orders);
    }
}
