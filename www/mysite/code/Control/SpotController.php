<?php

class SpotController extends ObjectController {

	private static $object_type = 'Spot';

	private static $url_segment = 'spot';

	private static $url_handlers = array(
		'$ID/$Action' => 'handleAction',
		'$ID' => 'index',
	);

	private static $allowed_actions = array(
		'add',
		'added',
	);

	public function index($request) {
		if ($this->getObject()->exists()) {
			//do something
		}
		else {
			return $this->add($request);
		}
	}

	public function add($request) {
		return AddSpotController::create()
			->setBaseURL($this->Link())
			->setObject($this->getObject())
			->handleRequest($request, $this->model);
	}

}
