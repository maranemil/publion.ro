<?php //echo $this->renderElement('post',$post); ?>
<? //print_r($arTmpCatSubCats); ?>

<?
foreach ($arTmpState as $itemSel) {
   $JudeteAll .= "<option value='" . $itemSel["judets"]["id"] . "'> " . $itemSel["judets"]["judet"] . "</option >	";
}
// image 		 	 	 	 	 	 		 	 	 	 	
?>

<div class="registerBox">

    <span> Adauga anunt nou </span><BR><BR>

    <form method="post" action="<?php echo $html->url('/cars/step2/'); ?>" enctype="multipart/form-data">

        <div class="register_group">JUDET</div>
        <div class="register_input">
            <select name="data[Car][state]" id="data[Car][state]">
			   <?= $JudeteAll ?>
            </select>
        </div>

        <div class="register_group">Descriere</div>
        <div class="register_input">
            <textarea name="data[Car][info]" style="width:300px; height: 150px"><?= $post[0]['Car']['info']; ?></textarea>
		   <?php echo $form->error('Car/info', 'Trebuie sa adaugi o descriere...'); ?>
        </div>

        <div class="register_group"> Tip:</div>
        <div class="register_input">
            <select name="data[Car][type]" id="data[Car][type]">
                <option value='ALFA ROMEO'>ALFA ROMEO</option>
                <option value='ARO'>ARO</option>
                <option value='AUDI'>AUDI</option>
                <option value='BMW'>BMW</option>
                <option value='CHEVROLET'>CHEVROLET</option>
                <option value='CHRYSLER'>CHRYSLER</option>

                <option value='CITROEN'>CITROEN</option>
                <option value='DACIA'>DACIA</option>
                <option value='DAEWOO'>DAEWOO</option>
                <option value='DAIHATSU'>DAIHATSU</option>
                <option value='DODGE'>DODGE</option>
                <option value='FIAT'>FIAT</option>

                <option value='FORD'>FORD</option>
                <option value='GMC'>GMC</option>
                <option value='HONDA'>HONDA</option>
                <option value='HUMMER'>HUMMER</option>
                <option value='HYUNDAI'>HYUNDAI</option>
                <option value='IMS'>IMS</option>

                <option value='INFINITI'>INFINITI</option>
                <option value='ISUZU'>ISUZU</option>
                <option value='JAGUAR'>JAGUAR</option>
                <option value='JEEP'>JEEP</option>
                <option value='KIA'>KIA</option>
                <option value='LADA'>LADA</option>

                <option value='LANCIA'>LANCIA</option>
                <option value='LAND ROVER'>LAND ROVER</option>
                <option value='LEXUS'>LEXUS</option>
                <option value='LINCOLN'>LINCOLN</option>
                <option value='MAZDA'>MAZDA</option>
                <option value='MERCEDES'>MERCEDES</option>

                <option value='MG'>MG</option>
                <option value='MINI'>MINI</option>
                <option value='MITSUBISHI'>MITSUBISHI</option>
                <option value='NISSAN'>NISSAN</option>
                <option value='OLDSMOBILE'>OLDSMOBILE</option>
                <option value='OLTCIT'>OLTCIT</option>

                <option value='OPEL'>OPEL</option>
                <option value='PEUGEOT'>PEUGEOT</option>
                <option value='PONTIAC'>PONTIAC</option>
                <option value='PORSCHE'>PORSCHE</option>
                <option value='PROTON'>PROTON</option>
                <option value='RENAULT'>RENAULT</option>

                <option value='ROVER'>ROVER</option>
                <option value='SAAB'>SAAB</option>
                <option value='SEAT'>SEAT</option>
                <option value='SKODA'>SKODA</option>
                <option value='SMART'>SMART</option>
                <option value='SSANG YONG'>SSANG YONG</option>

                <option value='SUBARU'>SUBARU</option>
                <option value='SUZUKI'>SUZUKI</option>
                <option value='TOYOTA'>TOYOTA</option>
                <option value='VOLKSWAGEN'>VOLKSWAGEN</option>
                <option value='VOLVO'>VOLVO</option>
                <option value='WARTBURG'>WARTBURG</option>
            </select>

        </div>

        <div class="register_group"> Pret:</div>
        <div class="register_input">
		   <?php echo $form->text('Car/price', array('size' => '20', 'value' => $post[0]['Car']['price'])); ?>
        </div>

        <div class="register_group"> Anul:</div>
        <div class="register_input">
            <select name="data[Car][years]" id="data[Car][years]">
			   <?
			   $yrc = date("Y");
			   for ($yr = 1980; $yr <= $yrc; $yr++) {
				  if ($yr != $yrc) {
					 echo "<option value='" . $yr . "' > " . $yr . " </option>";
				  }
				  else {
					 echo "<option value='" . $yr . "' selected> " . $yr . " </option>";
				  }
			   }
			   ?>
            </select>
        </div>

        <div class="register_group"> Km:</div>
        <div class="register_input">
		   <?php echo $form->text('Car/km', array('size' => '20', 'value' => $post[0]['Car']['km'])); ?>
        </div>

        <div class="register_group"> Putere:</div>
        <div class="register_input">
		   <?php echo $form->text('Car/power', array('size' => '20', 'value' => $post[0]['Car']['power'])); ?>
        </div>

        <div class="register_group"> cmc:</div>
        <div class="register_input">
		   <?php echo $form->text('Car/cmc', array('size' => '20', 'value' => $post[0]['Car']['cmc'])); ?>
        </div>

        <div class="register_group"> Viteze:</div>
        <div class="register_input">
            <select name="data[Car][speeds]">
                <option value='Manuala 4+1'>Manuala 4+1</option>
                <option value='Manuala 5+1'>Manuala 5+1</option>
                <option value='Manuala 6+1'>Manuala 6+1</option>
                <option value='Automata'>Automata</option>
                <option value='TIPTRONIC'>TIPTRONIC</option>
                <option value='STEPTRONIC'>STEPTRONIC</option>
                <option value='GEARTRONIC'>GEARTRONIC</option>
                <option value='SENSODRIVE'>SENSODRIVE</option>
                <option value='EASYTRONIC'>EASYTRONIC</option>
                <option value='SHIFTTRONIC'>SHIFTTRONIC</option>
                <option value='MULTITRONIC'>MULTITRONIC</option>
            </select>
        </div>

        <div class="register_group"> Persoana:</div>
        <div class="register_input">
		   <?php echo $form->text('Car/person', array('size' => '20', 'value' => $post[0]['Car']['person'])); ?>
        </div>

        <div class="register_group"> Telefon:</div>
        <div class="register_input">
		   <?php echo $form->text('Car/phone', array('size' => '20', 'value' => $post[0]['Car']['phone'])); ?>
        </div>

        <div class="register_group">Pagina web:</div>
        <div class="register_input">
		   <?php echo $form->text('Car/web', array('size' => '20', 'value' => $post[0]['Car']['web'])); ?>
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

