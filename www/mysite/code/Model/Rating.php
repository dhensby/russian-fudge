<?php

class Rating extends DataObject {

	private static $db = array(
		'Rating' => 'Int(1)',
	);

	private static $has_one = array(
		'Item' => 'Item',
		'Photo' => 'Image',
	);

}
