<?php

	class string {
		
		function __construct () { }
		
		// generates random string
		public function generate ($chars = 20) {
			$i = 1;
			$result = array();
			while ($i <= $chars) {
				$result[] = mt_rand (1, 26);
				$i++;
			}
			$rndi = mt_rand (1, $chars);
			$rndn = array();
			$n = 1;
			while ($n <= $rndi) {
				$rndn[] = mt_rand (1, $chars);
				$n++;
			}
			$rndn = array_unique ($rndn);
			foreach ($rndn as $k1 => $v1) {
				$result[$v1] = chr (mt_rand (97, 122));
			}
			return substr (strtoupper (str_replace (".", "", implode (".", $result))), 0 , $chars);
		}
		
	
	}	

?>