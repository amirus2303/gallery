<?php 
function chargerClasse($class){
	$class = strtolower($class);
  	include INCLUDES_PATH.'/'.$class . '.php'; // On inclut la classe correspondante au paramètre passé.

}
spl_autoload_register('chargerClasse');

function redirect($location){
	header("Location: {$location}");
}
?>