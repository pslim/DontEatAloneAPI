<?php

// use DEA\Transformers\UserTransformer;

class UsersController extends ApiController {

	/**
	 * @var DEA\Transformers\UserTransformer
	 */
	// protected $userTransformer;

	// function __construct(UserTransformer $userTransformer) {
	// 	$this->userTransformer = $userTransformer;
	// }

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
			// 'data' => $this->userTransformer->transformCollection($users->all())
			'data' => [
				'users' => $users->all()
			]
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {

		// Validation
		$validator = Validator::make(Input::all(), User::$rules);
		if ($validator->fails()) {
			return $this->respondCreateError('Parameters failed validation for a user.');
		}

		$input = Input::all();
		// if (!isset($input['image_url'])) {
		// 	$faker = Faker\Factory::create();
		// 	$input['image_url'] = $faker->imageUrl(640, 480, 'cats');
		// }
		$user = User::create($input);

		Auth::login($user);

		return $this->respondCreated('User successfully created.', [
			'data' => [
				'user' => $user
			]
		]);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$user = User::find($id);

		if (!$user) {
			return $this->respondNotFound('User does not exist.');
		}

		return $this->respond([
			// 'data'	=>	$this->userTransformer->transform($user)
			'data'	=>	$user
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
		// $user = User::whereId($id)->first();
		// if ($user == null) {
		// 	return 'User does not exist';
		// }

		// // TODO: Validation

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
