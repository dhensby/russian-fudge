<?php

class ObjectController extends Controller {

	private static $object_type;

	private $object;

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
			Debug::show($this->getObject());
			$obj = $this->getObjectFromRequest($request);
			Debug::show($obj);
			if (!$obj) {
				return $this->httpError(404);
			}
			$this->setObject($obj);
		}
		return parent::handleAction($request, $action);
	}

}
