<?php

class RootController extends BaseController {

	public function index($request) {
		return $this;
	}

	public function Spots() {
		return Spot::get();
	}

}
