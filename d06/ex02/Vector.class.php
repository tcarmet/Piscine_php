<?PHP

require_once '../ex01/Vertex.class.php';
// Vector normalize();

class Vector {
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 1.0;
	public static $verbose = FALSE;

	public function getW() {return ($this->_w);}
	public function setW($w) {$this->_w = $w;}
	public function getX() {return ($this->_x);}
	public function setX($x) {$this->_x = $x;}
	public function getY() {return ($this->_y);}
	public function setY($y) {$this->_y = $y;}
	public function getZ() {return ($this->_z);}
	public function setZ($z) {$this->_z = $z;}

	public static function doc()
	{
		echo file_get_contents("Vector.doc.txt");
	}

	function __construct(array $kwargs) {
		if (!array_key_exists('dest', $kwargs))
			return ;
		if (!array_key_exists('orig', $kwargs))
			$kwargs['orig'] = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0));
		$this->_x = $kwargs['dest']->getX() - $kwargs['orig']->getX();
		$this->_y = $kwargs['dest']->getY() - $kwargs['orig']->getY();
		$this->_z = $kwargs['dest']->getZ() - $kwargs['orig']->getZ();
		$this->_w = $kwargs['dest']->getW() - $kwargs['orig']->getW();
		if (self::$verbose)
		{
			printf("Vector( x:%3.2f, y:%3.2f, z:%3.2f, w:%3.2f ) constructed\n",
				$this->_x, $this->_y, $this->_z, $this->_w);
		}
		return ;
	}

	public function magnitude() {
		return (sqrt(($this->_x * $this->_x) + ($this->_y * $this->_y) + ($this->_z * $this->_z)));
	}

	public function normalize() {
		$magnitude = $this->magnitude();
		$NewVertex = new Vertex (array('x' => $this->getX() / $magnitude,
			'y' => $this->getY() / $magnitude, 'z' => $this->getZ() / $magnitude));
		$NewVec = new Vector ( array('dest' => $NewVertex));
		return ($NewVec);
	}

	public function add(Vector $rhs) {
		$NewVertex = new Vertex ( array('x' => $this->getX() + $rhs->getX(),
			'y' => $this->getY() + $rhs->getY(), 'z' => $this->getZ() + $rhs->getZ()));
		$newVec = new Vector ( array('dest' => $NewVertex));
		return ($newVec);
	}

	public function sub(Vector $rhs) {
		$NewVertex = new Vertex ( array('x' => $this->getX() - $rhs->getX(),
			'y' => $this->getY() - $rhs->getY(), 'z' => $this->getZ() - $rhs->getZ()));
		$newVec = new Vector ( array('dest' => $NewVertex));
		return ($newVec);
	}

	public function opposite() {
		return (new Vector ( array( 'dest' => new Vertex ( array ('x' => 0, 'y' => 0, 'z' => 0, 'w' => 0) ) , 
			'orig' => new Vertex ( array ('x' => $this->_x, 'y' => $this->_y, 'z' => $this->_z, 'w' => $this->_w) ) ) ) );
	}

	public function scalarProduct( $k ) {
		$NewVertex = new Vertex ( array('x' => $this->getX() * $k,
			'y' => $this->getY()  * $k, 'z' => $this->getZ()  * $k) );
		$newVec = new Vector ( array('dest' => $NewVertex));
		return ($newVec);	
	}

	public function dotProduct( Vector $rhs ) {
		return (round(($this->_x * $rhs->_x) + ($rhs->_y * $this->_y) + ($this->_z * $rhs->_z) + ($this->_w * $rhs->_w), 4));
	}

	public function cos( Vector $rhs ) {
		return ($this->dotProduct($rhs) / (abs($this->magnitude() * 
			sqrt($rhs->getX() * $rhs->getX() + $rhs->getY() * $rhs->getY() + $rhs->getZ() * $rhs->getZ() ) ) ) );
	}

	public function crossProduct( Vector $rhs ) {
		$x1 = round($this->_y * $rhs->_z - $this->_z * $rhs->_y, 2);
		$y1 = round($this->_z * $rhs->_x - $this->_x * $rhs->_z, 2);
		$z1 = round($this->_x * $rhs->_y - $this->_y * $rhs->_x, 2);
		return (new Vector( array ( 'dest' => new Vertex ( array( 'x' => $x1, 'y' => $y1, 'z' => $z1) ) ) ) );
	}

	function __destruct() {
		if (self::$verbose)
		{
			printf("Vector( x:%3.2f, y:%3.2f, z:%3.2f, w:%3.2f ) destructed\n",
				$this->_x, $this->_y, $this->_z, $this->_w);
		}
	}

	function __toString()
	{
		return (sprintf("Vector( x:%3.2f, y:%3.2f, z:%3.2f, w:%3.2f )",
				$this->_x, $this->_y, $this->_z, $this->_w));
	}
}
?>
