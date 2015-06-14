<?php

use DEA\Transformers\MatchTransformer;
use DEA\Forms\MatchForm;

class MatchesController extends ApiController {

	/**
	 * @var DEA\Transformers\MatchTransformer
	 */
	protected $matchTransformer;

	/**
	 * @var DEA\Forms\MatchForm
	 */
	protected $matchForm;


	function __construct(MatchTransformer $matchTransformer, MatchForm $matchForm) {
		$this->matchTransformer = $matchTransformer;
		$this->matchForm = $matchForm;

		// $this->beforeFilter('auth.basic', ['on' => 'post']);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param null $id
	 * @return Response
	 */
	public function index() {
		$limit = Input::get('limit') ? : 30;
		// TODO: max limit that the client can retrieve
		$matches = Match::with('user.profile')->paginate($limit);

		return $this->respondWithPagination($matches, [
			'matches' => $this->matchTransformer->transformCollection($matches->all())
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		// TODO: rules in Match, validation(all fields should be filled in)
		// TODO: figure out security in posting a new match preference

		// if (Match::whereUserId(Input::get('user_id')) != null) {
		// 	return 'User has already created a match';
		// }

		// Store in database(for now fields can be nullable)
		if (!$this->matchForm->validate(Input::all())) {
			return 'failed validation';
		}

		$match = new Match;
		if ($userId = Input::get('user_id')) {
			$match->user_id = $userId;
		} 

		if ($maxDistance = Input::get('max_distance')) {
			$match->max_distance = $maxDistance;
		}

		if ($minAge = Input::get('min_age')) {
			$match->min_age = $minAge;
		}

		if ($maxAge = Input::get('max_age')) {
			$match->max_age = $maxAge;
		}

		if ($minPrice = Input::get('min_price')) {
			$match->min_price = $minPrice;
		} 

		if ($minPrice = Input::get('max_price')) {
			$match->max_price = $minPrice;
		} 

		if ($comment = Input::get('comment')) {
			$match->comment = $comment;
		}

		if ($gender = Input::get('gender')) {
			$match->gender = $gender;
		}

		if ($startTime = Input::get('start_time')) {
			$match->start_time = $startTime;
		}

		if ($endTime = Input::get('end_time')) {
			$match->end_time = $endTime;
		}

		$match->save();

		return $this->respondCreated('Match successfully created.', [
			'match' => $match
		]);


		// $newMatch = Match::whereUserId($userId)->first();
		// return $newMatch;
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

    // Retrieved from http://stackoverflow.com/questions/27928/how-do-i-calculate-distance-between-two-latitude-longitude-points
	public function getDistanceInKm($lat1, $long1, $lat2, $long2) {
		$R = 6371;	// Radius of the earth in km
		$dLat = $this->degToRad($lat2 - $lat1);
		$dLong = $this->degToRad($long2 - $long1);
		$a = 
			sin($dLat/2) * sin($dLat/2) + 
			cos($this->degToRad($lat1)) * cos($this->degToRad($lat2)) *
			sin($dLong/2) * sin($dLong/2);

		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
		$d = $R * $c;	// Distance in km
		return $d;
	}

	public function degToRad($deg) {
		return $deg * (M_PI/180);
	}

	public function matchesForUser($userId) {
		$preference = Match::whereUserId($userId)->first();

		$lat = $preference->latitude;
		$long = $preference->longitude;
		$maxDistance = $preference->max_distance;
		$minAge = $preference->min_age;
		$maxAge = $preference->max_age;
		$minPrice = $preference->min_price;
		$maxPrice = $preference->max_price;
		$gender = $preference->gender;
		$start_time = $preference->start_time;
		$end_time = $preference->end_time;

		$limit = Input::get('limit') ? : 15;

		$matches = Match::with('user.profile')
				->join('profiles','matches.user_id', '=', 'profiles.user_id')
				->where('profiles.age', '>=', $minAge)
				->where('profiles.age', '<=', $maxAge)
				->where('matches.min_price', '>=', $minPrice)
				->where('matches.max_price', '<=', $maxPrice)
				->where('profiles.gender', '=', $gender)
				->where('matches.start_time', '>=', $start_time)
				->where('matches.end_time', '<=', $end_time)
				->paginate($limit);

		return $this->respondWithPagination($matches, [
			'preference' => $this->matchTransformer->transform($preference),
			'matches' => $this->matchTransformer->transformCollection($matches->all())
		]);
	}
}
