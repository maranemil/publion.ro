<?php
// Creo il navigatore.
#$html->addCrumb(__("Home", TRUE), "/");
?>

<div class="headFirma">
    <span>Firme</span><BR><BR>
   <?
   $arAlphabet = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

   foreach ($arAlphabet as $sletter) {
	  echo '<a href="' . $this->webroot . 'firms/showfirmbyletter/' . $sletter . '" class="letterFirma">' . $sletter . '&nbsp</a>';
   }
   ?>
</div>

<?php
if ((is_array($arTmpFirm)) && (!empty($arTmpFirm))) {
   foreach ($arTmpFirm as $sTmpArt):
	  echo $this->renderElement("firm", $sTmpArt);
   endforeach;
   echo $this->renderElement('pagination', $paging);
}
?>

<?
if (empty($arTmpFirm)) {
   echo "<div class='noresults'>" . $message . "</div>";
}

?>
