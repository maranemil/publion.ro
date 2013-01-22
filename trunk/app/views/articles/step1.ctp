<?php //echo $this->renderElement('post',$post); ?>
	<? //print_r($arTmpCatSubCats); ?>

<?
	foreach($arTmpCatSubCats as $itemSel){
		$Categories.= "
		<option value='".$itemSel["categories"]["id"]."-".$itemSel["subcategories"]["id"]."'> 
		".$itemSel["categories"]["name"]." - ".$itemSel["subcategories"]["name"]."
		</option >
		";
	}
?>

<div class="registerBox">

		<div class="switchstep">In cazul in care doriti sa adaugati un anunt specific categoriilor Auto sau Imobiliare, in care sa adaugati mai multe detalii, puteti accesa formularele speciale <? echo $html->link(" Auto ","/cars/step1");?> sau <? echo $html->link("Imobiliare ","/houses/step1");?>.
		</div><BR><BR>

		<span> <?=$GLOBALS["LBL"]["anuntnou_title"]?> </span><BR><BR>

		<form method="post" action="<?php echo $html->url('/articles/step2/'); ?>" enctype="multipart/form-data">

		<div class="register_group"><?=$GLOBALS["LBL"]["anuntnou_categorie"]?> </div>
		<div class="register_input">
			<select name="data[Article][category]" id="Article/category_id">
				<?=$Categories?>
			</select>
		</div>

		<div class="register_group"> Titlu:</div>
		<div class="register_input">
		<?php echo $form->text('Article/title', array('size' => '20','value'=>$post[0]['Article']['title'])); ?>
		</div>

		<div class="register_group">Descriere </div>
		<div class="register_input">
		<textarea name="data[Article][descr]" style="width:300px; height: 150px"><?=$post[0]['Article']['descr']; ?></textarea>
		<?php echo $form->error('Article/descr', 'Trebuie sa adaugi o descriere...'); ?>
		</div>

		<div class="register_group"> Telefon:</div>
		<div class="register_input">
		<?php echo $form->text('Article/phone', array('size' => '20','value'=>$post[0]['Article']['phone'])); ?>
		</div>

		<div class="register_group"> Pret:</div>
		<div class="register_input">
		<?php echo $form->text('Article/price', array('size' => '20','value'=>$post[0]['Article']['price'])); ?>
		</div>

		<div class="register_group">Webpage:</div>
		<div class="register_input">
		<?php echo $form->text('Article/webpage', array('size' => '20','value'=>$post[0]['Article']['webpage'])); ?>
		</div>

		<BR><BR>
		<?php
			echo $form->create('Image/images', array('action' => 'add', 'type' => 'file'));
			echo $form->file('File');
		?>

		<?php echo $html->file('File'); ?>

		<BR><BR>
		<?php echo $form->submit('Adauga'); ?>
		</form>

		
</div>

