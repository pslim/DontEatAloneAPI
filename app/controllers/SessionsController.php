<?php

class SessionsController extends ApiController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::only('email', 'password');
		if (!Auth::attempt($input)) {
			return $this->respond([
				'message' => 'Login failed!'
			]);
		}

		$user = User::whereEmail($input['email'])->first();

		return $this->respond([
			'message' => 'Login successful!',
			'data' => [
				'user' => $user
			]
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
		Auth::logout();

		return $this->respond([
			'message' => 'Logout successful!'
		]);
	}

}
