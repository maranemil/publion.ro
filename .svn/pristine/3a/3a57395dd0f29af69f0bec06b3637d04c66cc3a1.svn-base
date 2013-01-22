<?php
// Creo il navigatore.
$html->addCrumb(__("Home", TRUE), "/");

// &listtype=1

$listtype = $this->params['url']['listtype'];
if(!$listtype) $listtype = 2;
if($listtype==1) $renderElemSel = "article_list";
else if($listtype==2) $renderElemSel = "article_thumb";
else if($listtype==3) $renderElemSel = "article";

?>

<?php if(isset($arTmpArt)){?>
	<?php foreach ($arTmpArt as $sTmpArt): ?>
		<?php echo $this->renderElement($renderElemSel, $sTmpArt); ?>
	<?php endforeach; ?>
	<? echo $this->renderElement('pagination', $paging);?> 
	<? echo $this->renderElement('listtype','');?>
<?php } else { ?>
	<div class="infoBox">
		<? echo $message;?>
	</div>
<?php } ?>
