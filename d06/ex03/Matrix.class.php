<?PHP

class Matrix {
	const IDENTITY = "IDENTITY";
	const SCALE = "SCALE preset";
	const RX = "Ox ROTATION preset";
	const RY = "Oy ROTATION preset";
	const RZ = "Oz ROTATION preset";
	const TRANSLATION = "TRANSLATION preset";
	const PROJECTION = "PROJECTION preset";
	public static $verbose = False;
	private $_matrix = array(array(1, 0, 0, 0), array(0, 1, 0, 0), array(0, 0, 1, 0), array(0, 0, 0, 1));

	public static function doc()
	{
		echo file_get_contents("Matrix.doc.txt");
	}

	private function do_da_rot($mode, $rot) {
		if ($mode == self::RX)
		{
			$this->_matrix[1][1] = cos($rot);
			$this->_matrix[1][2] = -sin($rot);
			$this->_matrix[2][1] = sin($rot);
			$this->_matrix[2][2] = cos($rot);
		}
		else if ($mode == self::RY)
		{
			$this->_matrix[0][0] = cos($rot);
			$this->_matrix[0][2] = sin($rot);
			$this->_matrix[2][0] = -sin($rot);
			$this->_matrix[2][2] = cos($rot);
		}
		else if ($mode == self::RZ)
		{
			$this->_matrix[0][0] = cos($rot);
			$this->_matrix[0][1] = -sin($rot);
			$this->_matrix[1][0] = sin($rot);
			$this->_matrix[1][1] = cos($rot);
		}
	}

	private function PerspectiveMatrix( $fov, $ratio, $near, $far)
	{
		$scale = tan(deg2rad($fov * 0.5)) * $near;
		$right = $ratio * $scale;
		$left = -$right;
		$top = $scale;
		$bottom = -$top;
		$this->_matrix[0][0] = (2 * $near) / ($right - $left);
		$this->_matrix[0][1] = 0;
		$this->_matrix[0][2] = ($right + $left) / ($right - $left);
		$this->_matrix[0][3] = 0;
		$this->_matrix[1][0] = 0;
		$this->_matrix[1][1] = (2 * $near) / ($top - $bottom);
		$this->_matrix[1][2] = ($top + $bottom) / ($top - $bottom);
		$this->_matrix[1][3] = 0;
		$this->_matrix[2][0] = 0;
		$this->_matrix[2][1] = 0;
		$this->_matrix[2][2] = -(($far + $near) / ($far - $near));
		$this->_matrix[2][3] = -((2 * $far * $near) / ($far - $near));
		$this->_matrix[3][0] = 0;
		$this->_matrix[3][1] = 0;
		$this->_matrix[3][2] = -1;
		$this->_matrix[3][3] = 0;
	}

	function __construct (array $kwargs) {
		if (!array_key_exists('preset', $kwargs))
			return ;
		if (self::$verbose)
			printf("Matrix %s instance constructed\n", $kwargs['preset']);
		if ($kwargs['preset'] == self::SCALE && array_key_exists('scale', $kwargs))
		{
			$this->_matrix[0][0] *= $kwargs['scale'];
			$this->_matrix[1][1] *= $kwargs['scale'];
			$this->_matrix[2][2] *= $kwargs['scale'];
		}
		if (array_key_exists('angle', $kwargs))
		{
			$this->do_da_rot($kwargs['preset'], $kwargs['angle']);
		}
		if ($kwargs['preset'] == self::TRANSLATION && array_key_exists('vtc', $kwargs))
		{
			$this->_matrix[0][3] += $kwargs['vtc']->getX();
			$this->_matrix[1][3] += $kwargs['vtc']->getY();
			$this->_matrix[2][3] += $kwargs['vtc']->getZ();
		}
		if ($kwargs['preset'] == self::PROJECTION  && array_key_exists('fov', $kwargs)
			&& array_key_exists('ratio', $kwargs) && array_key_exists('near', $kwargs)
			&& array_key_exists('far', $kwargs))
		{
			$this->PerspectiveMatrix($kwargs['fov'], $kwargs['ratio'], $kwargs['near'], $kwargs['far']);
		}
	}

	public function mult( Matrix $rhs ) {
		$tmp = Matrix::$verbose;
		Matrix::$verbose = FALSE;
		$ret = new Matrix (array('preset' => Matrix::IDENTITY));
		Matrix::$verbose = $tmp;
		for ($i = 0; $i < 4; $i++)
		{
			for ($j = 0; $j < 4; $j++)
			{
				$ret->_matrix[$i][$j] = $this->_matrix[$i][0] * $rhs->_matrix[0][$j]
				+ $this->_matrix[$i][1] * $rhs->_matrix[1][$j] + $this->_matrix[$i][2]
				* $rhs->_matrix[2][$j] + $this->_matrix[$i][3] * $rhs->_matrix[3][$j];
			}
		}
		return ($ret);
	}

	public function transformVertex ( Vertex $vtx ) {
		$newX = $vtx->getX() * $this->_matrix[0][0] + $vtx->getY() *
			$this->_matrix[0][1] + $vtx->getZ() * $this->_matrix[0][2] + $this->_matrix[0][3];
		$newY = $vtx->getX() * $this->_matrix[1][0] + $vtx->getY() *
			$this->_matrix[1][1] + $vtx->getZ() * $this->_matrix[1][2] + $this->_matrix[1][3];
		$newZ = $vtx->getX() * $this->_matrix[2][0] + $vtx->getY() *
			$this->_matrix[2][1] + $vtx->getZ() * $this->_matrix[2][2] + $this->_matrix[2][3];
		$newW = $vtx->getX() * $this->_matrix[3][0] + $vtx->getY() *
			$this->_matrix[3][1] + $vtx->getZ() * $this->_matrix[3][2] + $this->_matrix[3][3];
		return ( new Vertex ( array('x' => $newX / $newW, 'y' => $newY / $newW, 'z' => $newZ / $newW)));
	}

	function __toString()
	{
		return (sprintf("M | vtcX | vtcY | vtcZ | vtxO".PHP_EOL.
			"-----------------------------".PHP_EOL.
			"x | %3.2f | %3.2f | %3.2f | %3.2f".PHP_EOL.
			"y | %3.2f | %3.2f | %3.2f | %3.2f".PHP_EOL.
			"z | %3.2f | %3.2f | %3.2f | %3.2f".PHP_EOL.
			"w | %3.2f | %3.2f | %3.2f | %3.2f",
			$this->_matrix[0][0], $this->_matrix[0][1], $this->_matrix[0][2], $this->_matrix[0][3],
			$this->_matrix[1][0], $this->_matrix[1][1], $this->_matrix[1][2], $this->_matrix[1][3],
			$this->_matrix[2][0], $this->_matrix[2][1], $this->_matrix[2][2], $this->_matrix[2][3],
			$this->_matrix[3][0], $this->_matrix[3][1], $this->_matrix[3][2], $this->_matrix[3][3]));
	}

	public function __destruct() {
		if (self::$verbose)
			print("Matrix instance destructed\n");
		return;
	}

}

?>
