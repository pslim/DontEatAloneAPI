<?php

use DEA\Forms\RequestForm;

class RequestsController extends \BaseController {

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

}
