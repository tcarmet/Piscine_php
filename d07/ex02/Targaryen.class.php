<?php
	class Targaryen {
		public function __construct() {
			return;
		}

		public function resistsFire() {
			return FALSE;
		}

		public function getBurned() {
			if ($this->resistsFire())
				return "emerges naked but unharmed";
			else
				return "burns alive";
		}
	}
?>