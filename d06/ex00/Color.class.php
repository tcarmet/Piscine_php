<?PHP
class Color {
	public static $verbose = FALSE;

	public $red = 0;
	public $green = 0;
	public $blue = 0;

	private function check_valid_color($key, $array)
	{
		if (array_key_exists($key, $array))
			$mod = intval($array[$key]);
		else
			$mod = 0;
		return ($mod);
	}

	public static function doc()
	{
		echo file_get_contents("Color.doc.txt");
	}

	public function add(Color $col)
	{
		$red = $col->red + $this->red;
		$green = $col->green + $this->green;
		$blue = $col->blue + $this->blue;
		return (new Color(array('red' => $red, 'green' => $green, 'blue' => $blue)));
	}

	public function sub(Color $col)
	{
		$red = $this->red - $col->red;
		$green = $this->green - $col->green;
		$blue = $this->blue - $col->blue;
		return (new Color(array('red' => $red, 'green' => $green, 'blue' => $blue)));
	}

	public function mult($col)
	{
		$red = $col * $this->red;
		$green = $col * $this->green;
		$blue = $col * $this->blue;
		return (new Color(array('red' => $red, 'green' => $green, 'blue' => $blue)));
	}

	function __construct(array $array) {
		if (array_key_exists('rgb', $array))
		{
			$this->red = $array['rgb'] >> 16;
			$this->green = ($array['rgb'] - ($this->red << 16)) >> 8;
			$this->blue = ($array['rgb'] - ($this->red << 16) - ($this->green << 8));
		}
		else if (array_key_exists('red', $array) OR array_key_exists('blue', $array)
		OR array_key_exists('green', $array))
		{
			$this->red = $this->check_valid_color('red', $array);
			$this->green = $this->check_valid_color('green', $array);
			$this->blue = $this->check_valid_color('blue', $array);
		}
		else
		{
			$this->red = 0;
			$this->blue = 0;
			$this->green = 0;
		}
		if (self::$verbose)
			printf("Color( red: %3s, green: %3s, blue: %3s ) constructed.\n", $this->red, $this->green, $this->blue);
		return ;
	}

	function __toString()
	{
		return (sprintf("Color( red: %3s, green: %3s, blue: %3s )", $this->red, $this->green, $this->blue));
	}

	function __destruct() {
		if (self::$verbose)
			printf("Color( red: %3s, green: %3s, blue: %3s ) destructed.\n", $this->red, $this->green, $this->blue);
		return ;
	}
}
?>
