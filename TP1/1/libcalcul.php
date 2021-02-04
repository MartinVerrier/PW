<?php
	
	function resultat($somme, $taux, $duree) {
		$cumul = $somme * ( 1 + $taux/100 ) ** $duree;
		return $cumul;
	}

?>