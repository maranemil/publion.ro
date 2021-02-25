<?php
#Creo il navigatore.
#$html->addCrumb(__("Home", TRUE), "/");

//print_r($arTmpCategs);
?>

<div id="recipesCats">
    <span> Retete culinare</span><BR><BR>

   <?php
   foreach ($arTmpCategs as $arTmpCateg) {
	  echo "
		<a href='" . $this->webroot . "recipes/searchrecipe/?catrecipe=" . $arTmpCateg['recipes']['cat'] . "'>
		" . $arTmpCateg['recipes']['cat'] . "
		</a> * 
	";
   }
   ?>
</div>

<?php
foreach ($arTmpRecipe as $arTmpRec):
   echo $this->renderElement("recipe", $arTmpRec);
endforeach;
?>

<?
echo $this->renderElement('pagination', $paging);
?> 


