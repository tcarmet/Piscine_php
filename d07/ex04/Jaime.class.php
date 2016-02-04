<?php
	class Jaime {
		public function sleepWith($class)
		{
			if (get_class($class) == "Cersei")
				print("With pleasure, but only in a tower in Winterfell, then.\n");
			else if (get_class($class) == "Sansa")
				print("Let's do this.\n");
			else
				print("Not even if I'm drunk !\n");
		}
	}
?>