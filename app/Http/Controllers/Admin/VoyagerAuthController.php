<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class VoyagerAuthController extends Controller
{
	use AuthenticatesUsers;

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function login()
	{
		return view('voyager::login');
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{
		$this->validateLogin($request);

		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		if ($this->hasTooManyLoginAttempts($request)) {
			$this->fireLockoutEvent($request);

			return $this->sendLockoutResponse($request);
		}

		$credentials = $this->credentials($request);

		if ($this->guard()->attempt($credentials, $request->has('remember'))) {
			return $this->sendLoginResponse($request);
		}

		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		$this->incrementLoginAttempts($request);

		return $this->sendFailedLoginResponse($request);
	}

	/**
	 * @return string
	 */
	public function redirectPath()
	{
		return route('voyager.dashboard');
	}
}
