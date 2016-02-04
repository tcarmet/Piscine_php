<?PHP

require_once '../ex00/Color.class.php';

class Vertex {
	private $_w = 0;
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_color;
	public static $verbose = FALSE;

	public function getW() {return ($this->_w);}
	public function setW($w) {$this->_w = $w;}
	public function getX() {return ($this->_x);}
	public function setX($x) {$this->_x = $x;}
	public function getY() {return ($this->_y);}
	public function setY($y) {$this->_y = $y;}
	public function getZ() {return ($this->_z);}
	public function setZ($z) {$this->_z = $z;}
	public function getColor() {return ($this->_color);}
	public function setColor($color) {$this->_color = $color;}

	public static function doc()
	{
		echo file_get_contents("Vertex.doc.txt");
	}

	function __construct( array $kwargs )
	{
		if (array_key_exists('x', $kwargs) && array_key_exists('y', $kwargs) && array_key_exists('z', $kwargs))	{
			$this->_x = $kwargs['x'];
			$this->_y = $kwargs['y'];
			$this->_z = $kwargs['z'];
		}

		if (array_key_exists('w', $kwargs))
			$this->_w = $kwargs['w'];
		else
			$this->_w = 1.0;

		if (array_key_exists('color', $kwargs))
			$this->_color = $kwargs['color'];
		else
			$this->_color = new Color(array('red' => 255, 'green' => 255, 'blue' => 255));
		if (self::$verbose)
		{
			printf("Vertex( x: %3.2f, y: %3.2f, z:%3.2f, w:%3.2f, %3s ) constructed\n",
				$this->_x, $this->_y, $this->_z, $this->_w, $this->_color);
		}
	}

	function __destruct() {
		if (self::$verbose)
		{
			printf("Vertex( x: %3.2f, y: %3.2f, z:%3.2f, w:%3.2f, %3s ) destructed\n",
				$this->_x, $this->_y, $this->_z, $this->_w, $this->_color);
		}
	}

	function __toString()
	{
		if (self::$verbose)
		{
			return (sprintf("Vertex( x: %3.2f, y: %3.2f, z:%3.2f, w:%3.2f, %3s )",
				$this->_x, $this->_y, $this->_z, $this->_w, $this->_color));
		}
		else
		{
			return (sprintf("Vertex( x: %3.2f, y: %3.2f, z:%3.2f, w:%3.2f )",
				$this->_x, $this->_y, $this->_z, $this->_w));
		}
	}

}
?>
