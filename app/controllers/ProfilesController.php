<?php

use DEA\Forms\ProfileForm;

class ProfilesController extends ApiController {

	protected $profileForm;

	function __construct (ProfileForm $profileForm) {
		$this->profileForm = $profileForm;

		// $this->beforeFilter('currentUser', ['only' => ['update', 'destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$limit = Input::get('limit') ? : 30;
		$users = User::with('profile')->paginate($limit);

		return $this->respondWithPagination($users, [
			'users' => $users->all()
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($email) {
		$user = User::with('profile')->whereEmail($email)->firstOrFail();

		return $this->respond([
			'user' => $user
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($userId) {
		$user = User::findOrFail($userId);//->firstOrFail();
		$input = Input::only('name', 'image_url', 'gender', 'age', 'description');

		$this->profileForm->validate($input);

		$user->profile->fill($input)->save();

		return $this->respond([
			'message' => 'User\'s profile successfully updated.', 
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
	public function destroy($id) {
		//
	}


}
