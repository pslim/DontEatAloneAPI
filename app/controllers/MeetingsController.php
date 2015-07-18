<?php

class MeetingsController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//
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
		$meeting = Meeting::findOrFail($id);
		$user1 = User::findOrFail($meeting['user_id1']);
		$user2 = User::findOrFail($meeting['user_id2']);

		$meeting->delete();

		$deviceToken1 = $user1['gcm_token'];
		$deviceToken2 = $user2['gcm_token'];

		if ($deviceToken1 || $deviceToken2) {
			$devices = PushNotification::DeviceCollection(array(
			    PushNotification::Device($deviceToken1),
			    PushNotification::Device($deviceToken2)
			));

			$message = PushNotification::Message('Rate the other user!', array(
		    	'title'	=>	'Meeting has ended.',
		    	'type'	=>	'end_meeting'
			));

			$collection = PushNotification::app('appNameAndroid')
				->to($devices)
				->send($message);
		}



		// TODO:
		// Delete all notifications about the meeting
		// Delete all messages in this meeting
		// Put meeting id into messages table

		return $this->respondDeleted('Meeting has been successfully deleted.');
	}

	public function meetingsForUser($userId) {
		$limit = Input::get('limit') ? : 30;
		
		$meetings = Meeting::where('user_id1', '=', $userId)
			->orWhere('user_id2', '=', $userId)
			->paginate($limit);

		return $this->respondWithPagination($meetings, [
			'meetings' => $meetings->all()
		]);
	}

}
