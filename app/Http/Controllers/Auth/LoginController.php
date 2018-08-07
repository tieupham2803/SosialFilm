<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Socialite;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function getFacebookCallback()
    {
        $data = Socialite::driver('facebook')->user();
        $user = User::where('email', $data->email)->first();

        if (!is_null($user)) {
            Auth::login($user);
            $user->name = $data->user['name'];
            $user->facebook_id = $data->id;
            $user->save();
        } else {
            $user = User::where('facebook_id', $data->id)->first();
            if (is_null($user)) {
                $tmp['name'] = $data->user['name'];
                $tmp['email'] = $data->email;
                $tmp['facebook_id'] = $data->id;
                $tmp['avatar'] = $data->avatar_original;
                $newUser = User::create($tmp);
                Auth::login($newUser);
            } else {
                Auth::login($user);
            }
        }

        return redirect('/');
    }
}
