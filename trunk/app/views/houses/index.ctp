<?php
// Creo il navigatore.
#$html->addCrumb(__("Home", TRUE), "/");
?>
<?php
foreach ($arTmpArt as $sTmpArt):
    echo $this->renderElement("house", $sTmpArt);
endforeach;
?>
<?php echo $this->renderElement('pagination', $paging); ?>
