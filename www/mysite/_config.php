<?php

global $project;
$project = 'mysite';

require_once(FRAMEWORK_PATH . '/conf/ConfigureFromEnv.php');

// Set the site locale
i18n::set_locale('en_GB');
