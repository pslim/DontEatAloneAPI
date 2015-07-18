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
		$input = Input::only('user_id', 'to_user_id', 'match_id');
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
			$devices = PushNotification::DeviceCollection(array(
			    PushNotification::Device($deviceToken)
			));

			$message = PushNotification::Message('Someone has sent you a request!', array(
		    	'title'	=>	'Invitation',
		    	'type'	=>	'request'
			));

			$collection = PushNotification::app('appNameAndroid')
				->to($devices)
				->send($message);

		} else {
			//TODO:
			// save notification to database
			// when user logins to device they will call a URI to get all their requests(send notifications) 
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
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		// Note: This is basically rejecting a request.

		$request = UserRequest::findOrFail($id);
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
		$requests = UserRequest::with('user.profile')
			->join('matches', 'matches.user_id', '=', 'requests.user_id')
			->where('to_user_id', '=', $userId)->paginate($limit);

		return $this->respondWithPagination($requests, [
			'requests' => $this->requestTransformer->transformCollection($requests->all())
		]);
	}

	// $id - the request id
	public function acceptRequest($id) {
		// Check if the request/user_id/to_user_id exists
		$userRequest = UserRequest::findOrFail($id);
		$user1 = User::findOrFail($userRequest['user_id']);
		$user2 = User::findOrFail($userRequest['to_user_id']);

		// Delete the request
		$userRequest->delete();

		// Create a new meeting
		$meeting = new Meeting;
		$meeting->user_id1 = $user1['id'];
		$meeting->user_id2 = $user2['id'];
		$meeting->save();

		// Send notification about the meeting
		$deviceToken1 = $user1['gcm_token'];
		$deviceToken2 = $user2['gcm_token'];

		if ($deviceToken1 || $deviceToken2) {
			$devices = PushNotification::DeviceCollection(array(
			    PushNotification::Device($deviceToken1),
			    PushNotification::Device($deviceToken2)
			));

			$message = PushNotification::Message('Talk for details on where to meet!', array(
		    	'title'	=>	'Meeting has started.',
		    	'type'	=>	'meeting'
			));

			$collection = PushNotification::app('appNameAndroid')
				->to($devices)
				->send($message);
		}

		// Send a successfull message back to client
        return $this->respond([
        	'meeting'	=>	$meeting,
        	'message'	=>	'User\'s request was successfully accepted. Meeting has been created.'
        ]);
	}
}
