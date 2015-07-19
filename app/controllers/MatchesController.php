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

		$input = Input::only(
			'user_id', 
			'longitude',
			'latitude',
			'max_distance', 
			'min_age', 
			'max_age', 
			'min_price', 
			'max_price', 
			'start_time',
			'end_time',
			'comment', 
			'gender'
		);

		$this->matchForm->validate($input);
		$match = Match::create($input);

		return $this->respondCreated('Match successfully created.', [
			'match' => $match
		]);
 	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$match = Match::with('user.profile')->findOrFail($id);

		return $this->respond([
			'match'	=> $this->matchTransformer->transform($match)
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
		$match = Match::findOrFail($id);

		$match->delete();

		return $this->respondDeleted('Match has been successfully deleted.');
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
		$preference = Match::whereUserId($userId)->firstOrFail();

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

		$query = Match::with('user.profile','userRequest')
				->join('profiles','matches.user_id', '=', 'profiles.user_id')
				->where('profiles.age', '>=', $minAge)
				->where('profiles.age', '<=', $maxAge)
				->where('matches.min_price', '>=', $minPrice)
				->where('matches.max_price', '<=', $maxPrice)
				->where('matches.start_time', '>=', $start_time)
				->where('matches.end_time', '<=', $end_time)
				->orWhere('matches.start_time', '<=', $start_time)
				->where('matches.end_time','<=', $end_time)
				->orWhere('matches.start_time', '>=', $start_time)
				->where('matches.end_time', '>=', $end_time)
				->orWhere('matches.start_time', '<=', $start_time)
				->where('matches.end_time', '>=', $end_time)
				->where('matches.user_id', '<>', $userId);

		if ($gender != 'N') {
			$query = $query->where('profiles.gender', '=', $gender);
		}

		$matches = $query->orderBy('profiles.likes', 'DESC')
					->paginate($limit);

		// foreach($matches as $index => $match) {
		// 	$distance = $this->getDistanceInKm($lat, $long, $match->latitude, $match->longitude);

		// 	if ($distance > $maxDistance || $distance > $match->max_distance) {
		// 		unset($matches[$index]);
		// 	} else {
		// 		$match->distance = $distance;
		// 	}
		// }


		return $this->respondWithPagination($matches, [
			'preference' => $this->matchTransformer->transform($preference),
			'matches' => $this->matchTransformer->transformCollection($matches->all())
		]);

		// TODO: Fix pagination
		// return $this->respond([
		// 	'preference'	=>	$this->matchTransformer->transform($preference),
		// 	'matches'		=>	$this->matchTransformer->transformCollection($matches->flatten()->all()),
		// 	'paginator'			=>	[
		// 		'total_count'	=>	$matches->count()
		// 	]
		// ]);
	}
}
