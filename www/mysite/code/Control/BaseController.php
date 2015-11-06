<?php

class BaseController extends Controller {

	private static $url_segment = '';

	private $baseURL;

	public function setBaseURL($url) {
		$this->baseURL = $url;
		return $this;
	}

	public function getBaseURL() {
		return $this->baseURL;
	}

	public function Link($action = null) {
		Controller::join_links($this->getBaseURL(), $this->config()->url_segment, $action);
	}

	/*public function init() {
		parent::init();
		$googleService = new GooglePlacesService();
		$places = $googleService->getNearby(51.5076040, -0.0737460);

		foreach ($places as $item) {
			$spot = Spot::get()->filter(array(
				'GooglePlaceID' => $item['place_id'],
			))->first();
			if (!$spot) {
				$spot = Spot::create();
			}
			$spot->update(array(
				'Longitude' => $item['geometry']['location']['lng'],
				'Latitude' => $item['geometry']['location']['lat'],
				'GooglePlaceID' => $item['place_id'],
			))->write();
			Debug::show($spot->getGoogleDetails());
		}
	}*/

}
