<?php

class SpotController extends ObjectController {

	private static $object_type = 'Spot';

	private static $url_handlers = array(
		'new' => 'add',
		'$ID/$Action' => 'handleAction',
	);

	private static $allowed_actions = array(
		'add',
	);

	public function index($request) {
		Debug::show($this->getObject());
		Debug::message(__CLASS__);
	}

	public function add($request) {
		return AddSpotController::create()
			->setBaseURL($this->Link())
			->setObject($this->getObject())
			->handleRequest($request, $this->model);
	}

}
