<?php
	class Tyrion {
		public function sleepWith($class) {
			if (get_class($class) == "Sansa")
				print("Let's do this.\n");
			else
				print("Not even if I'm drunk !\n");
		}
	}
?>