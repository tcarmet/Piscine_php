<?php
	class House {

		public function __construct() {
			return;
		}

		public function introduce() {
			return (print("House {$this->getHouseName()} of {$this->getHouseSeat()} : \"{$this->getHouseMotto()}\"\n"));
		}
	}
?>