<?php

class SessionsController extends \BaseController {

    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make("sessions.login");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		if (Auth::attempt(Input::except("_token"))) {
            return Redirect::intended('/')->with("flash_message", "Login successful!");
        }
        return Redirect::back()->with('flash_message', "Incorrect username/password");
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy() {
        Auth::logout();

        return Redirect::route('home')->with('flash_message', "You are now logged out");
	}

}
