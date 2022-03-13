<?php
// Creo il navigatore.
#$html->addCrumb(__("Home", TRUE), "/");
?>

<?php
if (isset($arTmpArt)) {
    foreach ($arTmpArt as $sTmpArt):
        echo $this->renderElement("house", $sTmpArt);
    endforeach;
    echo $this->renderElement('pagination', $paging);
}
?>

<?php
if (!empty($message)) {
    echo "<div class='noresults'>" . $message . "</div>";
}
?> 