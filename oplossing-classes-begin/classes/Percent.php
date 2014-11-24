<?php 
	
	class Percent
	{
		public 	$absolute,
						$relative,
						$hundred,
						$nominal;



		function __construct($new, $unit)
		{
			$this->absolute = $this->formatNumber( $new / $unit );
			$this->relative = $this->formatNumber( $this->absolute - 1 );
			$this->hundred = $this->absolute * 100;

			if ($this->absolute > 1) {
				$this->nominal = "positive";
			}
			elseif ($this->absolute == 1) {
				$this->nominal = "status-quo";
			}
			elseif ($this->absolute < 1) {
				$this->nominal = "negative";
			}
		}

		public function formatNumber($number)
		{
			return number_format($number, 2);
		}


	}

 ?>