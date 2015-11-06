<?php

class Spot extends DataObject {

	private static $db = array(
		'Title' => 'Varchar(255)',
		'URLSegment' => 'Varchar(255)',
		'Latitude' => 'Varchar(10)',
		'Longitude' => 'Varchar(10)',
		'GooglePlaceID' => 'Varchar(30)',
	);

	private static $has_one = array(
		'AddedBy' => 'Member',
	);

	private static $has_many = array(
		'Items' => 'Item',
	);

	private static $indexes = array(
		'GooglePlaceID' => 'unique("GooglePlaceID")',
		'URLSegment' => 'unique("URLSegment")',
	);

	public function getGoogleDetails() {
		$service = new GooglePlacesService();
		$data = $service->getDetails($this->GooglePlaceID);
		return $data;

	}

}
