<?php
// Creo il navigatore.
$html->addCrumb(__("Home", true), "/");

?>

<?php foreach ($arTmpArt as $sTmpArt): ?>
    <?php echo $this->renderElement("article", $sTmpArt); ?>
<?php endforeach; ?>

<?php echo $this->renderElement('pagination', $paging); ?>
