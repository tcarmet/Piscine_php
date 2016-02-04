<?PHP

class UnholyFactory {
	private static $footsoldier;
	private static $archer;
	private static $assasin;
	private static $ObjectArray = array();

	private function check_absorb($fighter, &$already_absord)
	{
		if ($already_absord)
			echo "(Factory already absorbed a fighter of type " . $fighter . ")" . PHP_EOL;
		else
		{
			echo "(Factory absorbed a fighter of type " . $fighter . ")" . PHP_EOL;
			$already_absord = 1;
		}

	}

	public function absorb($object)
	{
		$class = get_class($object);
		self::$ObjectArray[$class] = clone $object;
		if ($class == "Footsoldier")
			self::check_absorb("foot soldier", self::$footsoldier);
		else if ($class == "Archer")
			self::check_absorb("archer", self::$archer);
		else if ($class == "Assassin")
			self::check_absorb("assassin", self::$assasin);
		else
			echo "(Factory can't absorb this, it's not a fighter)" . PHP_EOL;
	}

	public function fabricate($fighter)
	{
		if ($fighter == "foot soldier" || $fighter == 'archer' || $fighter == "assassin")
		{
			echo "(Factory fabricates a fighter of type " .  $fighter . ")" . PHP_EOL;
			$fighter = ucfirst($fighter);
			$fighter = str_replace(' ', '', $fighter);
			return self::$ObjectArray[$fighter];
		}
		else
		{
			echo "(Factory hasn't absorbed any fighter of type llama)" . PHP_EOL;
			return FALSE;
		}
	}
}

?>
