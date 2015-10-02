<?php

class BaseController extends Controller {

	private static $url_segment = '';

	public function init() {
		parent::init();

		$googleService = new GooglePlacesService();
		$resp = $googleService->getService()->get('nearbysearch/json', array(
			'query' => array(
				'location' => '51.5076040,-0.0737460',
				'keyword' => 'cake',
				'rankby' => 'distance',
				'type' => implode('|', array(
					'bakery',
					'bar',
					'cafe',
					'establishment',
					'food',
					'grocery_or_supermarket',
					'meal_delivery',
					'meal_takeaway',
					'restaurant',
					'store',
				)),
			),
		))->json();

		foreach ($resp['results'] as $item) {
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
	}

}
