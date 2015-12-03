<?php

class SpotSyncClass extends BuildTask {

	public function run($request) {
		foreach (Spot::get() as $spot) {
			$spot->write();
			$spot->destroy();
		}
		echo 'Done';
	}

}
