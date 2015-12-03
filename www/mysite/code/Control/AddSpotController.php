<?php

class AddSpotController extends ObjectController {

	private static $allowed_actions = array(
		'AddSpotForm',
	);

	private static $object_type = 'Spot';

	private static $url_segment = 'add';

	public function index($request) {

		return $this;

	}

	public function getURLSegment() {
		return Controller::join_links($this->getObject()->ID ?: 'new', $this->config()->url_segment);
	}

	public function AddSpotForm() {
		return AddSpotForm::create(
			$this,
			__FUNCTION__
		);
	}

}
