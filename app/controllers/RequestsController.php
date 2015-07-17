<?php

use DEA\Forms\RequestForm;
use DEA\Transformers\UserRequestTransformer;

class RequestsController extends ApiController {

	/**
	 * @var DEA\Forms\RequestForm
	 */
	protected $requestForm;

	/**
	 * @var DEA\Transformers\UserRequestTransformer
	 */
	protected $requestTransformer;

	function __construct(RequestForm $requestForm, UserRequestTransformer $requestTransformer) {
		$this->requestForm = $requestForm;
		$this->requestTransformer = $requestTransformer;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$limit = Input::get('limit') ? : 30;
		$requests = UserRequest::paginate($limit);

		return $this->respondWithPagination($requests, [
			'requests' => $this->requestTransformer->transformCollection($requests->all())
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::only('user_id', 'to_user_id');
		$this->requestForm->validate($input);
		$user = User::findOrFail($input['user_id']);
		$toUser = User::findOrFail($input['to_user_id']);

		// Check if request already exists
		$requestExists = UserRequest::where('user_id', '=', $input['user_id'])
			->where('to_user_id', '=', $input['to_user_id'])
			->count();

		if ($requestExists) {
			return $this->respondCreateError('User has already sent a request to this user.');
		}

		// Create the request
		$request = UserRequest::create($input);

		// TODO: Send a notification to that person
		$deviceToken = $toUser['gcm_token'];

		if ($deviceToken) {
			PushNotification::app('appNameAndroid')
				->to($deviceToken)
				->send('Someone has sent you a request!');
		} else {
			//TODO:
			// save notification to database
			// when user logins to device they will call a URI to get all their requests(send notifications) 
			dd('save notification to database');
		}

		return $this->respondCreated('Request successfully created.', [
			'request' => $this->requestTransformer->transform($request)
		]);

		//TODO:
		// If user is no longer in a meeting, delete all notifications/messages.
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$request = UserRequest::findOrFail($id);

		return $this->respond([
			'request' => $this->requestTransformer->transform($request)
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$request = Request::findOrFail($id);
		$request->delete();

		return $this->respondDeleted('Request has been successfully deleted.');
	}

	/**
	 * Display a listing of the resource for the specified user.
	 *
 	 * @param  int  $id
	 * @return Response
	 */
	public function requestsForUser($userId) {
		$limit = Input::get('limit') ? : 30;
		//TODO: Show user profiles
		$requests = UserRequest::with('user.profile')
			->join('matches', 'matches.user_id', '=', 'requests.user_id')
			->where('to_user_id', '=', $userId)->paginate($limit);

		return $this->respondWithPagination($requests, [
			'requests' => $this->requestTransformer->transformCollection($requests->all())
		]);
	}

	/**
	 * Display a listing of the resource.
	 *
  	 * @param  int  $id
	 * @return Response
	 */
	public function requestsFromUser($userId) {
		//TODO: Show user profiles
		$requests = UserRequest::where('user_id', '=', $userId)->get();

		return $this->respond([
			'requests' => $this->requestTransformer->transformCollection($requests->all())
		]);
	}

	// $id - the request id
	public function acceptRequest($id) {
		// $deviceToken = "fMeOvXgMwok:APA91bFFr4_GH7Le1i-Rrrx2x7s4_IY4jb7poh19zWnrp9fIWuhxI31pxgNsLFOja9LIzaFFOx50lx_L-OqzCBfBWqHkTwaH5mqCT3oi1ZwCAf_u9SQ3iXvpU_R5CGX0NJg6se89OC8Q";
		
		// $collection = PushNotification::app('appNameAndroid')
  //               		->to($deviceToken)
  //               		->send('Someone has sent you a request!');

  //       return $this->respond([
  //       	'message'	=>	'User\'s request was successfully accepted.'
  //       ]);

        //TODO: 
        //Create a meeting
        //Notify both users: 
        //Title: "Don't Eat Alone" Message: "You are now in a meeting! Talk for details on where to meet!"

	}

	// $id - the request id
	public function rejectRequest($id) {

	}

}
