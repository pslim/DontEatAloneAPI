<?php

use DEA\Forms\RequestForm;

class RequestsController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//
		dd("hello!");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::only('user_id', 'to_user_id');
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
		//
	}

	/**
	 * Display a listing of the resource for the specified user.
	 *
 	 * @param  int  $id
	 * @return Response
	 */
	public function requestsForUser($userId) {
		dd("requestsForUser!");
	}

	/**
	 * Display a listing of the resource.
	 *
  	 * @param  int  $id
	 * @return Response
	 */
	public function requestsFromUser($userId) {
		dd("requestsFromUser!");
	}

	// $id - the request id
	public function acceptRequest($id) {
		$deviceToken = "fMeOvXgMwok:APA91bFFr4_GH7Le1i-Rrrx2x7s4_IY4jb7poh19zWnrp9fIWuhxI31pxgNsLFOja9LIzaFFOx50lx_L-OqzCBfBWqHkTwaH5mqCT3oi1ZwCAf_u9SQ3iXvpU_R5CGX0NJg6se89OC8Q";
		
		$collection = PushNotification::app('appNameAndroid')
                		->to($deviceToken)
                		->send('Someone has sent you a request!');

        return $this->respond([
        	'message'	=>	'User\'s request was successfully accepted.'
        ]);

	}

}
