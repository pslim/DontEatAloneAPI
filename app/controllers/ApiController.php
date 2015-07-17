<?php 

use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Pagination\Paginator;

class ApiController extends BaseController {

	/**
	 * @var int
	 */
	protected $statusCode = 200;

	/**
	 * @return mixed
	 */
	public function getStatusCode() {
		return $this->statusCode;
	}

	/**
	 * @param mixed $statusCode
	 * @return $this
	 */
	public function setStatusCode($statusCode) {
		$this->statusCode = $statusCode;

		return $this;
	}

	/**
	 * @param array $headers
	 * @return mixed
	 */
	public function respond($data, $headers = []) {
		return Response::json($data, $this->getStatusCode(), $headers);
	}

	/**
	 * @param Paginator $items
	 * @param $data
	 * @return mixed
	 */
	protected function respondWithPagination(Paginator $items, $data) {
		$limit = $items->getPerPage();
		$totalCount = $items->getTotal();
		$totalPages = ceil($totalCount / $limit);
		$currentPage = $items->getCurrentPage();

		if ($currentPage > 1) {
			$prevPage = $currentPage - 1;
			$prevPage = $items->getUrl($prevPage);
		} else {
			$prevPage = '';
		}

		if ($currentPage < $totalPages) {
			$nextPage = $currentPage + 1;
			$nextPage = $items->getUrl($nextPage);
		} else {
			$nextPage = '';
		}

		$data = array_merge($data, [
			'paginator'	=>	[
				'total_count'	=>	$totalCount,
				'total_pages'	=>	$totalPages,
				'current_page'	=>	$currentPage,
				'next_page'		=>	$nextPage,
				'prev_page'		=>	$prevPage,
				'limit'			=>	$limit
			]
		]);

		return $this->respond($data);
	}

	/**
	 * @param $message
	 * @return mixed
	 */
	public function respondWithError($message) {
		return $this->respond([
			'error'	=>	[
				'message'		=>	$message,
				'status_code'	=>	$this->getStatusCode()
			]
		]);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function respondNotFound($message = 'Not Found!') {
		return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function respondInternalError($message = 'Internal Error!') {
		return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	protected function respondCreated($message, $data) {

		$data = array_merge($data, [
			'message' => $message
		]);

		return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond($data);
	}

	protected function respondDeleted($message) {
		return $this->respond([
			'message' => $message
		]);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	protected function respondCreateError($message) {
		return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
	}
}