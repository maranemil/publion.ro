<?php
// Creo il navigatore.
$html->addCrumb(__("Home", true), "/");
?>

<?php foreach ($arCompanies as $company): ?>
   <?php echo $this->renderElement("company", $company); ?>
<?php endforeach; ?>