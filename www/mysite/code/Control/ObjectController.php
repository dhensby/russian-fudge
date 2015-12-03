<?php

class ObjectController extends Controller {


	private static $object_type;

	private static $url_segment = '';

	private $object;

	private $baseURL = '';

	public function setBaseURL($url) {
		$this->baseURL = $url;
		return $this;
	}

	public function getBaseURL() {
		return $this->baseURL;
	}

	public function getURLSegment() {
		return $this->config()->url_segment;
	}

	public function Link($action = null) {
		return Controller::join_links($this->getBaseURL(), $this->getURLSegment(), $action);
	}

	public function getObject() {
		return $this->object;
	}

	public function setObject($obj) {
		$class = $this->config()->object_type;
		if ($obj instanceof $class) {
			$this->object = $obj;
			return $this;
		}
		throw new LogicException(
			sprintf('Unable to use object type %s, %s required', get_class($obj), $this->config()->object_type)
		);
	}

	public function getObjectFromRequest($request = null) {
		if (!$request) {
			$request = $this->getRequest();
		}
		$id = $request->latestParam('ID');
		$class = $this->config()->object_type;
		if ($id == 'new') {
			return $class::create();
		}
		elseif (intval($id) == $id) {
			return $class::get()->byID($id);
		}
	}

	protected function handleAction($request, $action) {
		if (!$this->getObject()) {
			$obj = $this->getObjectFromRequest($request);
			if (!$obj) {
				return $this->httpError(404);
			}
			$this->setObject($obj);
		}
		return parent::handleAction($request, $action);
	}

}
