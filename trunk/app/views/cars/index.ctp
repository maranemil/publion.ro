<?php
// Creo il navigatore.
#$html->addCrumb(__("Home", TRUE), "/");
?>


<?php 

foreach ($arTmpArt as $sTmpArt): 
	echo $this->renderElement("car", $sTmpArt); 
endforeach; 

?>

<? echo $this->renderElement('pagination', $paging);?> 
