<?php
// Creo il navigatore.
$html->addCrumb(__("Home", true), "/");

// &listtype=1

$listtype = $this->params['url']['listtype'];
if (!$listtype) {
    $listtype = 2;
}
if ($listtype === 1) {
    $renderElemSel = "article_list";
}
else if ($listtype === 2) {
    $renderElemSel = "article_thumb";
}
else if ($listtype === 3) {
    $renderElemSel = "article";
}

?>

<?php foreach ($arTmpArt as $sTmpArt): ?>
    <?php echo $this->renderElement($renderElemSel, $sTmpArt); ?>
<?php endforeach; ?>

<?php echo $this->renderElement('pagination', $paging); ?>
<?php echo $this->renderElement('listtype', ''); ?>


