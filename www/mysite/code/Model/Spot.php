<?php

class Spot extends DataObject {

	private static $db = array(
		'Title' => 'Varchar(255)',
		'URLSegment' => 'Varchar(255)',
		'Latitude' => 'Varchar(10)',
		'Longitude' => 'Varchar(10)',
		'GooglePlaceID' => 'Varchar(30)',
		'GoogleData' => 'Text',
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
		$this->GoogleData = $data;
		return $data;
	}

	public function setGoogleData($val) {
		unset($val['reviews']);
		return $this->setField('GoogleData', serialize($val));
	}

	public function getGoogleData() {
		$data = $this->getField('GoogleData');
		if ($data) {
			return unserialize($data);
		}
		return array();
	}

	public function hasField($field) {
		return parent::hasField($field) || array_key_exists($field, $this->GoogleData);
	}

	public function getField($name) {
		$val = parent::getField($name);
		if (null === $val && $name != 'GoogleData') {
			if (array_key_exists($name, $this->GoogleData)) {
				return $this->GoogleData[$name];
			}
		}
		return $val;
	}

	protected function onBeforeWrite() {
		parent::onBeforeWrite();
		$details = $this->getGoogleDetails();
		$this->GoogleData = $details;

		if (!$this->Title) {
			$this->Title = $details['name'];
		}

		if (!$this->Latitude || !$this->Longitude) {
			$this->Latitude = $details['geometry']['location']['lat'];
			$this->Longitude = $details['geometry']['location']['lng'];
		}
	}

	public function Link($action = null) {
		return Controller::join_links('spot', ($this->ID ?: 'new'), $action);
	}

}
