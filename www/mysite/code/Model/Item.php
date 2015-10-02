<?php

/**
 * Class Item
 *
 * A food object
 */
class Item extends DataObject {

	private static $db = array(
		'Title' => 'Varchar(255)',
	);

	private static $has_one = array(
		'CreatedBy' => 'Member',
	);

	private static $has_many = array(
		'Ratings' => 'Rating',
	);

	private static $many_many = array(
		'Tags' => 'Tag',
	);

	public function Photos() {
		return Image::get()->filter(array(
			'Ratings.ID' => $this->Ratings()->getIDList(),
		));
	}

}
