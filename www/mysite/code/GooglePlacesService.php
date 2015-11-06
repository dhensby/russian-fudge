<?php

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Cache\CacheSubscriber;

class GooglePlacesService {

	private $service;

	private static $base_url = 'https://maps.googleapis.com/maps/api/place/';

	private static $server_api_key = 'AIzaSyAXB5C7rjLFBYICVpN7Is4q8vibNlrb1DM';

	private static $browser_api_key = '';

	private static $success_status = array(
		'OK',
		'ZERO_RESULTS',
	);

	private static $error_status = array(
		'OVER_QUERY_LIMIT',
		'REQUEST_DENIED',
		'INVALID_REQUEST',
		'UNKNOWN_ERROR',
	);

	public function getService() {
		if (!$this->service) {
			$this->setService(new Client(array(
				'base_url' => $this->config()->get('base_url'),
				'defaults' => array(
					'query' => array(
						'key' => $this->config()->get('server_api_key'),
					),
				),
			)));
		}
		return $this->service;
	}

	public function setService($service) {
		CacheSubscriber::attach($service);
		$this->service = $service;
		return $this;
	}

	public function config() {
		return Config::inst()->forClass(get_class());
	}

	public function getDetails($placeID) {
		$response = $this->getService()->get('details/json', array(
			'query' => array(
				'placeid' => $placeID,
			),
		));

		$data = $response->json();
		if (in_array($data['status'], $this->config()->get('error_status'))) {
			throw new ErrorException($data['error_message']);
		}
		return $data['result'];
	}

	public function getNearby($lat, $lng) {
		$resp = $this->getService()->get('nearbysearch/json', array(
			'query' => array(
				'location' => sprintf('%f,%f', $lat, $lng),
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
		));

		$data = $resp->json();
		if (in_array($data['status'], $this->config()->get('error_status'))) {
			throw new ErrorException($data['error_message']);
		}
		return $data['results'];
	}

}
