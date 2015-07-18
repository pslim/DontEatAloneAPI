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
		$meeting->delete();

		// TODO:
		// Delete all notifications about the meeting
		// Delete all messages in this meeting
		// Put meeting id into messages table

		return $this->respondDeleted('Meeting has been successfully deleted.');
	}

	public function meetingsForUser($userId) {
		
	}

}
