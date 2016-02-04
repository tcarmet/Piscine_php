<?php
	class NightsWatch implements IFighter {

		public function fight() {
		}

		public function recruit($class)
		{
			if (get_class($class) != "MaesterAemon")
				$class::fight();
		}
	}
?>