<?php

class AddSpotForm extends BaseForm {

	public function __construct(
		$controller,
		$name,
		FieldList $fields = null,
		FieldList $actions = null,
		$validator = null
	) {
		parent::__construct($controller, $name, $fields, $actions, $validator);
		$this->addExtraClass('js-places-search-form');
	}

	public function getFormFields() {
		$fields = parent::getFormFields();
		$fields->push(TextField::create('Title', 'Place name')->addExtraClass('js-place-title'));
		$fields->push(HiddenField::create('PlaceID')->addExtraClass('js-place-id'));
		return $fields;
	}

	/**
	 * @param array $rawData
	 * @param Form $form
	 * @param SS_HTTPRequest $request
	 */
	protected function doSubmit($rawData, $form, $request) {
		$data = $form->getData();
		$spot = Spot::get()->filter(array(
			'GooglePlaceID' => $data['PlaceID'],
		))->first();
		if (!$spot || !$spot->exists()) {
			$spot = Spot::create();
			$spot->GooglePlaceID = $data['PlaceID'];
			$spot->write();
		}
		$this->getController()->redirect($spot->Link('added'));
	}

}
