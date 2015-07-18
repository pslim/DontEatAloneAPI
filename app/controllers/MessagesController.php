<?php

use DEA\Transformers\MessageTransformer;
use DEA\Forms\MessageForm;

class MessagesController extends ApiController {

	/**
	 * @var DEA\Transformers\MessageTransformer
	 */
	protected $messageTransformer;

	/**
	 * @var DEA\Forms\MessageForm
	 */
	protected $messageForm;

	function __construct(MessageTransformer $messageTransformer, MessageForm $messageForm) {
		$this->messageTransformer = $messageTransformer;
		$this->messageForm = $messageForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::only('user_id', 'to_user_id', 'message');

		$this->messageForm->validate($input);

		$user = User::with('profile')->findOrFail($input['user_id']);
		$toUser = User::findOrFail($input['to_user_id']);

		$sendMessage = UserMessage::create($input);
		$deviceToken = $toUser['gcm_token'];
		if ($deviceToken) {
			// PushNotification::app('appNameAndroid')
			// 	->to($deviceToken)
			// 	->send($sendMessage);

			$devices = PushNotification::DeviceCollection(array(
			    PushNotification::Device($deviceToken)
			));

			$message = PushNotification::Message($input['message'], array(
		    	'title'	=>	$user['profile']['name'],
		    	'type'	=>	'msg'
			));

			$collection = PushNotification::app('appNameAndroid')
				->to($devices)
				->send($message);
		}

		return $this->respondCreated('Message successfully created.', [
			'user_message'	=>	$sendMessage
		]);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
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

	public function messagesForUser($userId) {
		$limit = Input::get('limit') ? : 30;

		$messages = UserMessage::with('user.profile')
			->where('to_user_id', '=', $userId)
			->paginate($limit);

		return $this->respondWithPagination($messages, [
			'messages'	=>	$this->messageTransformer->transformCollection($messages->all())
		]);

	}

}
