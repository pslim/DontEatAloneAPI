<?php

use DEA\Transformers\UserTransformer;
use DEA\Forms\UserForm;
use DEA\Forms\ProfileForm;

class UsersController extends ApiController {

	/**
	 * @var DEA\Transformers\UserTransformer
	 */
	protected $userTransformer;

	protected $userForm;

	protected $profileForm;

	function __construct(UserTransformer $userTransformer, UserForm $userForm, ProfileForm $profileForm) {
		$this->userTransformer = $userTransformer;
		$this->userForm = $userForm;
		$this->profileForm = $profileForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		$limit = Input::get('limit') ? : 30;
		// TODO: max limit that the client can retrieve
		$users = User::paginate($limit);

		return $this->respondWithPagination($users, [
			'users' => $this->userTransformer->transformCollection($users->all())
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {

		$userData = Input::only('email', 'password', 'password_confirmation', 'facebook_id');
		$this->userForm->validate($userData);
		$userData['password'] = Hash::make($userData['password']);

		$user = User::create($userData);
		$profileData = Input::only('name', 'image_url', 'gender', 'age', 'description', 'user_id');
		$this->profileForm->validate($profileData);

		$profileData['user_id'] = $user->id;
		$profile = new Profile();
		$profile->user_id = $profileData['user_id'];

		if (isset($input['name'])) {
			$profile->name = $input['name'];
		}

		if (isset($input['image_url'])) {
			$profile->image_url = $input['image_url'];
		}

		if (isset($input['gender'])) {
			$profile->gender = $input['gender'];
		}

		if (isset($input['age'])) {
			$profile->age = $input['age'];
		}

		if (isset($input['description'])) {
			$profile->description = $input['description'];
		}

		$profile->save();
		Auth::login($user);

		$user = User::with('profile')->whereId($profile['user_id'])->first();
		return $this->respondCreated('User successfully created.', [
			'user'	=> $user
			// 'user' => $this->userTransformer->transform($user)
		]);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$user = User::with('profile')->find($id);

		if (!$user) {
			return $this->respondNotFound('User does not exist.');
		}

		return $this->respond([
			// 'user' => $this->userTransformer->transform($user)
			'user'	=>	$user
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		// // Check if user id exists
		$user = User::findOrFail($id);
		$input = Input::only('facebook_id', 'gcm_token');	//TODO: support change password later
		// $this->userForm->validate($input);
		$user->fill($input)->save();

		return $this->respond([
			'message' => 'User was successfully updated.',
			'data' => [
				'user'	=> $user
			]
		]);

		// NOTE: BELOW IS CURRENTLY UPDATED IN PROFILESCONTROLLER

		// // Update fields if they were inputted parameters
		// if ($password = Input::get('password')) {
		// 	$user->password = Hash::make($password);
		// }

		// if ($name = Input::get('name')) {
		// 	$user->name = $name;
		// }

		// if ($facebookToken = Input::get('facebook_token')) {
		// 	$user->facebook_token;
		// }

		// if ($imageUrl = Input::get('image_url')) {
		// 	$user->image_url = $imageUrl;
		// }

		// if ($gender = Input::get('gender')) {
		// 	$user->gender = $gender;
		// }

		// if ($age = Input::get('age')) {
		// 	$user->age = $age;
		// }

		// if ($description = Input::get('description')) {
		// 	$user->description = $description;
		// }

		// $user->save();

		// // Return the user we just updated
		// $updatedUser = User::whereId($id)->first();

		// return $updatedUser;
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
