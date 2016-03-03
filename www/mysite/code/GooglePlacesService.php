<?php

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Cache\CacheSubscriber;

class GooglePlacesService implements TemplateGlobalProvider {

	private $service;

	private static $base_url = 'https://maps.googleapis.com/maps/api/place/';

	private static $server_api_key = 'AIzaSyAR1kh7Htkp4z8WAIwXx3Fbz2oAdV5n2JY';

	private static $browser_api_key = 'AIzaSyAR1kh7Htkp4z8WAIwXx3Fbz2oAdV5n2JY';

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

	public static function config() {
		return Config::inst()->forClass(get_called_class());
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
					'food',
					'grocery_or_supermarket',
					'meal_delivery',
					'meal_takeaway',
					'restaurant',
				)),
			),
		));

		$data = $resp->json();
		if (in_array($data['status'], $this->config()->get('error_status'))) {
			throw new ErrorException($data['error_message']);
		}
		return $data['results'];
	}

	public static function get_template_global_variables() {
		return array(
			'GMapsAPIKey' => 'get_browser_key',
		);
	}

	public static function get_browser_key() {
		return self::config()->browser_api_key;
	}

}
