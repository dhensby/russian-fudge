<?php

class HelpfulRating extends DataObject {

	private static $db = array(
		'isHelpful' => 'Boolean',
	);

	private static $has_one = array(
		'Member' => 'Member',
	);

}
