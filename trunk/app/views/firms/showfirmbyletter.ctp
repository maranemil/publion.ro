<?php
// Creo il navigatore.
#$html->addCrumb(__("Home", TRUE), "/");
?>

<div class="headFirma">
    <span>Firme</span><BR><BR>
    <?php
    $arAlphabet = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

    foreach ($arAlphabet as $sletter) {
        echo '<a href="' . $this->webroot . 'firms/showfirmbyletter/' . $sletter . '" class="letterFirma">' . $sletter . '&nbsp</a>';
    }
    ?>
</div>

<?php
foreach ($arTmpFirm as $sTmpArt):
    echo $this->renderElement("firm", $sTmpArt);
endforeach;
?>

<?php echo $this->renderElement('pagination', $paging); ?>
