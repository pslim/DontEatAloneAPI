<?php

class MatchesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		return Match::all();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		// TODO: rules in Match, validation(all fields should be filled in)
		// TODO: figure out security in posting a new match preference

		if (Match::whereUserid(Input::get('userId')) == null) {
			return 'User already has already created a match';
		}

		// Store in database(for now fields can be nullable)
		$match = new Match;
		if ($userId = Input::get('userId')) {
			$match->userId = $userId;
		} 

		if ($maxDistance = Input::get('maxDistance')) {
			$match->maxDistance = $maxDistance;
		}

		if ($minAge = Input::get('minAge')) {
			$match->minAge = $minAge;
		}

		if ($maxAge = Input::get('maxAge')) {
			$match->maxAge = $maxAge;
		}

		if ($minPrice = Input::get('minPrice')) {
			$match->minPrice = $minPrice;
		} 

		if ($comment = Input::get('comment')) {
			$match->comment = $comment;
		}

		if ($gender = Input::get('gender')) {
			$match->gender = $gender;
		}

		if ($startTime = Input::get('startTime')) {
			$match->startTime = $startTime;
		}

		if ($endTime = Input::get('endTime')) {
			$match->endTime = $endTime;
		}

		$match->save();

		$newMatch = Match::whereUserid($userId)->first();
		return $newMatch;
 	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		return Match::whereId($id)->first();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
