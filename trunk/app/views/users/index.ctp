<?php
// Creo il navigatore.
$html->addCrumb(__("Home", true), "/");
?>

<?php foreach ($arUser as $User): ?>
   <?php echo $this->renderElement("user", $User); ?>
<?php endforeach; ?>

<?php echo $this->renderElement('pagination', $paging); ?>