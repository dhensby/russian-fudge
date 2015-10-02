<?php

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Cache\CacheSubscriber;

class GooglePlacesService {

	private $service;

	private static $base_url = 'https://maps.googleapis.com/maps/api/place/';

	private static $server_api_key = 'AIzaSyAR1kh7Htkp4z8WAIwXx3Fbz2oAdV5n2JY';

	private static $browser_api_key = '';

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

	public function getDetails() {
	}

}
